<x-guest-layout>
    @auth
        {{ Html::linkRoute('task_statuses.create', __('task_status.create'), null, ['class' => 'btn btn-primary mb-3']) }}
    @endauth

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
                <td>{{ $model->id }}</td>
                <td>{{ $model->name }}</td>
                <td>{{ $model->created_at->format('d.m.Y') }}</td>
                @auth

                    <td>
                        {{ Html::linkRoute('task_statuses.destroy', __('task_status.destroy'), $model, ['class' => 'btn btn-sm btn-danger', 'data-method' => 'delete', 'data-confirm' => __('Are you sure?'), 'rel' => 'nofollow']) }}
                        {{ Html::linkRoute('task_statuses.edit', __('task_status.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}
                    </td>

                @endauth
            </tr>

        @endforeach

        </tbody>
    </table>

    {{ $models->links() }}
</x-guest-layout>
