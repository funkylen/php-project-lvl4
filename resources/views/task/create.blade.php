@include('task._form', [
    'route' => 'tasks.store',
    'buttonText' => __('task.store'),

    'statuses' => $statuses,
    'assignees' => $assignees,

    'name' => old('task.name'),
    'description' => old('task.description'),
    'statusId' => old('task.status_id'),
    'assignedToId' => old('task.assigned_to_id'),
])
