<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskStatus\StoreRequest;
use App\Http\Requests\TaskStatus\UpdateRequest;
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
            'models' => TaskStatus::paginate(),
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        TaskStatus::create($request->validated());

        flash()->success(__('task_status.stored'));

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

    public function update(UpdateRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->update($request->validated());

        flash()->success(__('task_status.updated'));

        return redirect(route('task_statuses.index'));
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash()->error(__('task_status.has_tasks'));
            return back()->withErrors([
                'message' => __('task_status.has_tasks'),
            ]);
        }

        $taskStatus->delete();

        flash()->success(__('task_status.deleted'));

        return redirect(route('task_statuses.index'));
    }
}
