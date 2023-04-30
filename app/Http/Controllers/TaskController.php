<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
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
            ->paginate();

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

    public function store(StoreRequest $request): RedirectResponse
    {
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

    public function update(UpdateRequest $request, Task $task): RedirectResponse
    {
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
