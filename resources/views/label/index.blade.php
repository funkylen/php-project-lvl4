<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

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
                                <th scope="row">{{ $model->id }}</th>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->description }}</td>
                                <td>{{ $model->created_at }}</td>
                                @auth

                                    <td>
                                        {{ Html::linkRoute('labels.edit', __('label.edit'), $model, ['class' => 'btn btn-sm btn-outline-primary']) }}
                                        {{ Html::linkRoute('labels.destroy', __('label.destroy'), $model, ['class' => 'btn btn-sm btn-danger', 'data-method' => 'delete', 'data-confirm' => __('Are you sure?'), 'rel' => 'nofollow']) }}
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
