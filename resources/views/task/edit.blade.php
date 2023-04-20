@include('task._form', [
    'route' => ['tasks.update', $model],
    'method' => 'PUT',
    'buttonText' => __('task.update'),

    'statuses' => $statuses,
    'assignees' => $assignees,

    'name' => $model->name,
    'description' => $model->description,
    'statusId' => $model->status_id,
    'assignedToId' => $model->assigned_to_id,
])
