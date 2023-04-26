@include('label._form', [
    'route' => 'labels.store',
    'buttonText' => __('label.store'),

    'name' => old('name'),
    'description' => old('description'),
])
