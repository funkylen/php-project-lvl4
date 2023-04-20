<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
            'models' => Task::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'task.name' => 'required|string',
            'task.description' => 'nullable|string',
            'task.status_id' => 'required|exists:tasks,id',
            'task.assigned_to_id' => 'required|exists:users,id',
            'task.created_by_id' => 'required|exists:users,id',
        ]);

        Task::create($validated['task']);

        flash()->success(__('task.stored'));

        return redirect(route('tasks.index'));
    }

    public function create(): View
    {
        return view('task.create');
    }

    public function edit(Task $task): View
    {
        return view('task.edit', [
            'model' => $task,
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'task.name' => 'string',
            'task.description' => 'nullable|string',
            'task.status_id' => 'exists:tasks,id',
            'task.assigned_to_id' => 'exists:users,id',
            'task.created_by_id' => 'exists:users,id',
        ]);

        $task->update($validated['task']);

        flash()->success(__('task.updated'));

        return redirect(route('tasks.index'));
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash()->success(__('task.deleted'));

        return redirect(route('tasks.index'));
    }
}
