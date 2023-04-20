@include('task_status._form', [
    'route' => ['task_statuses.update', $model],
    'method' => 'PUT',
    'buttonText' => __('task_status.update'),
    'value' => $model->name,
])
