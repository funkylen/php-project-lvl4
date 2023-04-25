<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(): View
    {
        return view('task.index', [
            'models' => Task::with('status', 'assignedTo', 'createdBy')->get(),
        ]);
    }

    public function show(int $id): View
    {
        return view('task.show', [
            'model' => Task::with('status')->findOrFail($id),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task.name' => 'required|string',
            'task.description' => 'nullable|string',
            'task.status_id' => 'required|exists:task_statuses,id',
            'task.assigned_to_id' => 'nullable|exists:users,id',
        ]);

        Task::create([
            ...$validated['task'],
            'created_by_id' => auth()->id(),
        ]);

        flash()->success(__('task.stored'));

        return redirect(route('tasks.index'));
    }

    public function create(): View
    {
        return view('task.create', [
            'statuses' => TaskStatus::all(),
            'assignees' => User::all(),
        ]);
    }

    public function edit(Task $task): View
    {
        return view('task.edit', [
            'statuses' => TaskStatus::all(),
            'assignees' => User::all(),
            'model' => $task,
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'task.name' => 'string',
            'task.description' => 'nullable|string',
            'task.status_id' => 'exists:task_statuses,id',
            'task.assigned_to_id' => 'nullable|exists:users,id',
        ]);

        $task->update($validated['task']);

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
