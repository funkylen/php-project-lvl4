@include('label._form', [
    'route' => 'labels.store',
    'method' => 'PUT',
    'buttonText' => __('label.store'),

    'name' => old('label.name'),
    'description' => old('label.description'),
])
