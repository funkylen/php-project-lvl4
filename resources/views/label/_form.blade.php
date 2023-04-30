<x-app-layout>

    {{ Form::open(['route' => $route, 'method' => $method ?? 'POST']) }}

    <div class="mb-3">
        <x-input-label for="name" :value="__('label.name')"/>
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$name"/>
        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
    </div>
    <div class="mb-3">
        <x-input-label for="description" :value="__('label.description')"/>
        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$description"/>
        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
    </div>

    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>

    {{ Form::close() }}

</x-app-layout>

