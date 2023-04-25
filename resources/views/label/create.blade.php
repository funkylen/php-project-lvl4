@include('label._form', [
    'route' => 'labels.store',
    'buttonText' => __('label.store'),

    'name' => old('label.name'),
    'description' => old('label.description'),
])
