<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskStatusRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(): View
    {
        return view('task_status.index', [
            'models' => TaskStatus::all(),
        ]);
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        TaskStatus::create($request->validated('task_status'));

        flash()->success(__('task_statuses.stored'));

        return redirect(route('task_statuses.index'));
    }

    public function create(): View
    {
        return view('task_status.create');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_status.edit', [
            'model' => $taskStatus,
        ]);
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->validated('task_status'));

        flash()->success(__('task_statuses.updated'));

        return redirect(route('task_statuses.index'));
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->delete();

        flash()->success(__('task_statuses.deleted'));

        return redirect(route('task_statuses.index'));
    }
}
