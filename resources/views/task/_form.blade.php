<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ Form::open(['route' => $route, 'method' => $method ?? 'POST']) }}


                    <div class="mb-3">
                        <x-input-label for="name" :value="__('task.name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="task[name]" :value="$name" required />
                        <x-input-error :messages="$errors->get('task.name')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="description" :value="__('task.description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="task[description]" :value="$description" />
                        <x-input-error :messages="$errors->get('task.description')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="status" :value="__('task.status')" />
                        <select id="status" name="task[status_id]" required class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value>------</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" @selected($statusId == $status->id)>{{ $status->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('task.status_id')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label for="status" :value="__('task.assigned_to_id')" />
                        <select id="assigned_to_id" name="task[assigned_to_id]" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value>------</option>
                            @foreach($assignees as $assignee)
                                <option value="{{ $assignee->id }}" @selected($assignedToId == $assignee->id)>{{ $assignee->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('task.assigned_to_id')" class="mt-2" />
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

