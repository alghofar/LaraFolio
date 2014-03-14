@section('title', 'My Settings' . trans('main.website.separator') . trans('main.website.title'))

@section('content')
    <div class="row">
        <h1 class="page-title">My Settings</h1>

        <div class="col-lg-8 col-lg-push-2">
            {{ Form::model($user, ['route' => 'users.postSettings', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) }}
                <div class="form-group{{ ($errors->has('username')) ? ' has-error' : '' }}">
                    {{ Form::label('username', trans('users.create.form.username.label'), ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.username.placeholder')]) }}
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('email', trans('users.create.form.email.label'), ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.email.placeholder'), 'disabled' => 'disabled']) }}
                    </div>
                </div>
                <div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
                    {{ Form::label('password', trans('users.create.form.new_password.label'), ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('users.create.form.new_password.placeholder')]) }}
                    </div>
                </div>
                <div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
                    {{ Form::label('password_confirmation', trans('users.create.form.password_confirmation.label'), ['class' => 'col-sm-3 control-label']) }}
                    <div class="col-sm-9">
                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('users.create.form.password_confirmation.placeholder')]) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        {{ Form::reset(trans('buttons.reset'), ['class' => 'btn btn-default']) }}
                        {{ Form::submit(trans('buttons.users.update.submit'), ['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
