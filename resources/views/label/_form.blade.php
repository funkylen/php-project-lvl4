<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ Form::open(['route' => $route, 'method' => $method ?? 'POST']) }}


                    <div class="mb-3">
                        <x-input-label for="name" :value="__('label.name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="label[name]" :value="$name" required />
                        <x-input-error :messages="$errors->get('label.name')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="description" :value="__('label.description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="label[description]" :value="$description" />
                        <x-input-error :messages="$errors->get('label.description')" class="mt-2" />
                    </div>

                    <x-primary-button>
                        {{ $buttonText }}
                    </x-primary-button>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

