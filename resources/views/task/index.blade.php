<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="row mb-3">
                        <div class="col-9">
                            {{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
                            <div class="flex gap-2">
                                <select id="status_id" name="filter[status_id]" class="form-select">
                                    <option value>@lang('task.status')</option>
                                    @foreach($statuses as $status)
                                        <option @selected(request('filter.status_id') == $status->id) value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                <select id="created_by_id" name="filter[created_by_id]" class="form-select">
                                    <option value>@lang('task.created_by_id')</option>
                                    @foreach($users as $user)
                                        <option @selected(request('filter.created_by_id') == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <select id="assigned_to_id" name="filter[assigned_to_id]" class="form-select">
                                    <option value>@lang('task.assigned_to_id')</option>
                                    @foreach($users as $user)
                                        <option @selected(request('filter.assigned_to_id') == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary">
                                    @lang('task.accept_filter')
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>

                        <div class="col-3">
                            {{ Html::linkRoute('tasks.create', __('task.create'), null, ['class' => 'btn btn-primary w-full']) }}
                        </div>
                    </div>


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
