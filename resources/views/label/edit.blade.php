@include('label._form', [
    'route' => ['labels.update', $model],
    'method' => 'PUT',
    'buttonText' => __('label.update'),

    'name' => $model->name,
    'description' => $model->description,
    'assignedToId' => $model->assigned_to_id,
])
