<x-guest-layout>

    @auth
        {{ Html::linkRoute('labels.create', __('label.create'), null, ['class' => 'btn btn-primary mb-3']) }}
    @endauth

    <table class="table">
        <thead>
        <tr>
            <th scope="col">@lang('label.id')</th>
            <th scope="col">@lang('label.name')</th>
            <th scope="col">@lang('label.description')</th>
            <th scope="col">@lang('label.created_at')</th>
            @auth
                <th scope="col">@lang('label.actions')</th>
            @endauth
        </tr>
        </thead>
        <tbody>

        @foreach($models as $model)

            <tr>
                <td>{{ $model->id }}</td>
                <td>{{ $model->name }}</td>
                <td>{{ $model->description }}</td>
                <td>{{ $model->created_at->format('d.m.Y') }}</td>
                @auth

                    <td>
                        {{ Html::linkRoute('labels.destroy', __('label.destroy'), $model, ['class' => 'btn btn-sm btn-danger', 'data-method' => 'delete', 'data-confirm' => __('Are you sure?'), 'rel' => 'nofollow']) }}
                        {{ Html::linkRoute('labels.edit', __('label.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}
                    </td>

                @endauth
            </tr>

        @endforeach

        </tbody>
    </table>

    {{ $models->links() }}
</x-guest-layout>
