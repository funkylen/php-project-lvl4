<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ Html::linkRoute('tasks.create', __('task.create'), null, ['class' => 'btn btn-primary mb-3']) }}

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">@lang('task.id')</th>
                            <th scope="col">@lang('task.status')</th>
                            <th scope="col">@lang('task.name')</th>
                            <th scope="col">@lang('task.created_by_id')</th>
                            <th scope="col">@lang('task.assigned_to_id')</th>
                            <th scope="col">@lang('task.created_at')</th>
                            @auth
                                <th scope="col">@lang('task.actions')</th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($models as $model)

                            <tr>
                                <th scope="row">{{ $model->id }}</th>
                                <td>{{ $model->status->name }}</td>
                                <td><a href="{{ route('tasks.show', $model) }}">{{ $model->name }}</a></td>
                                <td>{{ $model->createdBy->name }}</td>
                                <td>{{ $model->assignedTo?->name }}</td>
                                <td>{{ $model->created_at }}</td>
                                @auth

                                    <td>
                                        {{ Html::linkRoute('tasks.edit', __('task.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}

                                        @if(auth()->id() === $model->created_by_id)
                                            {{ Form::model($model,
                                                ['route' => ['tasks.destroy', $model],
                                                'method' => 'delete',
                                                'class' => 'btn btn-sm btn-danger',
                                                'onsubmit'=> 'return confirm("' . __('Are you sure?') .'")'])
                                            }}
                                            {{ Form::submit(__('task.destroy')) }}
                                            {{ Form::close() }}
                                        @endif
                                    </td>

                                @endauth
                            </tr>

                        @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
