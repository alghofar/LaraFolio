@section('title', 'Add a new User' . trans('main.website.separator') . trans('main.website.title'))

@section('content')
    <div class="row">
        <h1 class="page-title">Add a new User</h1>

        <div class="col-lg-8 col-lg-push-2">
            {{ Form::open(['route' => 'admin.users.store', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) }}
                @include('admin.users._form', ['submit_button' => trans('buttons.admin.users.create.submit')])
            {{ Form::close() }}
        </div>
    </div>
@stop
