<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(): View
    {
        $models = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
            ])
            ->with('status', 'assignedTo', 'createdBy')
            ->get();

        return view('task.index', [
            'models' => $models,
            'users' => User::all(),
            'statuses' => TaskStatus::all(),
        ]);
    }

    public function show(int $id): View
    {
        return view('task.show', [
            'model' => Task::with('status', 'labels')->findOrFail($id),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'labels' => 'nullable|array',
            'labels.*' => 'exists:labels,id',
        ]);

        DB::transaction(function () use ($request) {
            $task = Task::create([
                ...$request->except('labels'),
                'created_by_id' => auth()->id(),
            ]);

            $task->labels()->sync($request->get('labels'));
        });

        flash()->success(__('task.stored'));

        return redirect(route('tasks.index'));
    }

    public function create(): View
    {
        return view('task.create', [
            'statuses' => TaskStatus::all(),
            'assignees' => User::all(),
            'labels' => Label::all(),
            'taskLabelsIds' => collect(),
        ]);
    }

    public function edit(Task $task): View
    {
        return view('task.edit', [
            'statuses' => TaskStatus::all(),
            'assignees' => User::all(),
            'model' => $task,
            'labels' => Label::all(),
            'taskLabelsIds' => $task->labels()->pluck('id'),
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'status_id' => 'exists:task_statuses,id',
            'assigned_to_id' => 'nullable|exists:users,id',
            'labels' => 'array',
            'labels.*' => 'exists:labels,id',
        ]);


        DB::transaction(function () use ($request, $task) {
            $task->update($request->except('labels'));

            $task->labels()->sync($request->get('labels'));
        });

        flash()->success(__('task.updated'));

        return redirect(route('tasks.index'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        if (auth()->id() !== $task->created_by_id) {
            abort(403);
        }

        $task->delete();

        flash()->success(__('task.deleted'));

        return redirect(route('tasks.index'));
    }
}
