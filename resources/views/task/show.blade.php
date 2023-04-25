<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid col-span-full">
                        <h2 class="mb-5">
                            Просмотр задачи: {{ $model->name  }} <a href="{{ route('tasks.edit', $model) }}">⚙</a>
                        </h2>
                        <p><span class="font-black">Имя:</span>{{ $model->name }}</p>
                        <p><span class="font-black">Статус:</span>{{ $model->status->name }}</p>
                        <p><span class="font-black">Описание:</span>{{ $model->description }}</p>
                    </div>

                    @foreach($model->labels as $label)
                        <span class="badge text-bg-primary">
                            {{ $label->name }}
                        </span>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
