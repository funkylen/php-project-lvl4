<x-app-layout>

    {{ Form::open(['route' => $route, 'method' => $method ?? 'POST']) }}


    <div class="mb-3">
        <x-input-label for="name" :value="__('task_status.name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$value" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <x-primary-button>
        {{ $buttonText }}
    </x-primary-button>

    {{ Form::close() }}

</x-app-layout>

