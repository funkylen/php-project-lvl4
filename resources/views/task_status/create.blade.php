<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ Form::open(['route' => 'task_statuses.store']) }}


                    <div class="mb-3">
                        <x-input-label for="email" :value="__('task_status.name')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="text" name="task_status[name]" :value="old('task_status.name')" required />
                        <x-input-error :messages="$errors->get('task_status.name')" class="mt-2" />
                    </div>


                    <x-primary-button>
                        {{ __('task_status.store') }}
                    </x-primary-button>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
</x-app-layout>

