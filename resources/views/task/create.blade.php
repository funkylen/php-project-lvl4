@include('task._form', [
    'route' => 'tasks.store',
    'buttonText' => __('task.store'),

    'statuses' => $statuses,
    'assignees' => $assignees,

    'name' => old('name'),
    'description' => old('description'),
    'statusId' => old('status_id'),
    'assignedToId' => old('assigned_to_id'),
])
