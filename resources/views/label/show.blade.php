<x-guest-layout>

    <div class="grid col-span-full">
        <h2 class="mb-5">
            Просмотр задачи: {{ $model->name  }} <a href="{{ route('tasks.edit', $model) }}">⚙</a>
        </h2>
        <p><span class="font-black">Имя:</span>{{ $model->name }}</p>
        <p><span class="font-black">Статус:</span>{{ $model->status->name }}</p>
        <p><span class="font-black">Описание:</span>{{ $model->description }}</p>
    </div>

</x-guest-layout>
