<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{ Html::linkRoute('task_statuses.create', __('task_status.create'), null, ['class' => 'btn btn-primary mb-3']) }}

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">@lang('task_status.id')</th>
                            <th scope="col">@lang('task_status.name')</th>
                            <th scope="col">@lang('task_status.created_at')</th>
                            @auth
                                <th scope="col">@lang('task_status.actions')</th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($models as $model)

                            <tr>
                                <th scope="row">{{ $model->id }}</th>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->created_at }}</td>
                                @auth

                                    <td>
                                        {{ Form::model($model,
                                            ['route' => ['task_statuses.destroy', $model],
                                            'method' => 'delete',
                                            'class' => 'btn btn-sm btn-danger',
                                            'onsubmit'=> 'return confirm("' . __('Are you sure?') .'")'])
                                        }}
                                        {{ Form::submit(__('task_status.destroy')) }}
                                        {{ Form::close() }}

                                        {{ Html::linkRoute('task_statuses.edit', __('task_status.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}
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
