<x-guest-layout>

    <div class="row mb-3">
        <div class="col">
            {{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
            <div class="flex gap-2">
                <select id="status_id" name="filter[status_id]" class="form-select">
                    <option value>@lang('task.status')</option>
                    @foreach($statuses as $status)
                        <option
                            @selected(request('filter.status_id') == $status->id) value="{{ $status->id }}">{{ $status->name }}</option>
                    @endforeach
                </select>
                <select id="created_by_id" name="filter[created_by_id]" class="form-select">
                    <option value>@lang('task.created_by_id')</option>
                    @foreach($users as $user)
                        <option
                            @selected(request('filter.created_by_id') == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <select id="assigned_to_id" name="filter[assigned_to_id]" class="form-select">
                    <option value>@lang('task.assigned_to_id')</option>
                    @foreach($users as $user)
                        <option
                            @selected(request('filter.assigned_to_id') == $user->id) value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary">
                    @lang('task.accept_filter')
                </button>
            </div>
            {{ Form::close() }}
        </div>

        @auth
            <div class="col-3">
                {{ Html::linkRoute('tasks.create', __('task.create'), null, ['class' => 'btn btn-primary w-full']) }}
            </div>
        @endauth

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
                <td>{{ $model->id }}</td>
                <td>{{ $model->status->name }}</td>
                <td><a href="{{ route('tasks.show', $model) }}">{{ $model->name }}</a></td>
                <td>{{ $model->createdBy->name }}</td>
                <td>{{ $model->assignedTo?->name }}</td>
                <td>{{ $model->created_at->format('d.m.Y') }}</td>
                @auth

                    <td>
                        @if(auth()->id() === $model->created_by_id)
                            {{ Html::linkRoute('tasks.destroy', __('task.destroy'), $model, ['class' => 'btn btn-sm btn-danger', 'data-method' => 'delete', 'data-confirm' => __('Are you sure?'), 'rel' => 'nofollow']) }}
                        @endif
                        {{ Html::linkRoute('tasks.edit', __('task.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}
                    </td>

                @endauth
            </tr>

        @endforeach

        </tbody>
    </table>

    {{ $models->links() }}
</x-guest-layout>
