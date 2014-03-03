@section('content')
<div class="col-lg-8 col-lg-push-2">
    <h1 class="page-title">Registration</h1>
	{{ Form::open(['route' => 'users.postRegister', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) }}
		<div class="form-group{{ ($errors->has('username')) ? ' has-error' : '' }}">
			{{ Form::label('username', trans('users.create.form.username.label'), ['class' => 'col-sm-3 control-label']) }}
			<div class="col-sm-9">
				{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.username.placeholder')]) }}
			</div>
		</div>
		<div class="form-group{{ ($errors->has('email')) ? ' has-error' : '' }}">
			{{ Form::label('email', trans('users.create.form.email.label'), ['class' => 'col-sm-3 control-label']) }}
			<div class="col-sm-9">
				{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.email.placeholder')]) }}
			</div>
		</div>
		<div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
			{{ Form::label('password', trans('users.create.form.password.label'), ['class' => 'col-sm-3 control-label']) }}
			<div class="col-sm-9">
				{{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('users.create.form.password.placeholder')]) }}
			</div>
		</div>
		<div class="form-group{{ ($errors->has('password')) ? ' has-error' : '' }}">
			{{ Form::label('password_confirmation', trans('users.create.form.password_confirm.label'), ['class' => 'col-sm-3 control-label']) }}
			<div class="col-sm-9">
				{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('users.create.form.password_confirm.placeholder')]) }}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				{{ Form::reset(trans('buttons.users.register.reset'), ['class' => 'btn btn-default']) }}
				{{ Form::submit(trans('buttons.users.register.submit'), ['class' => 'btn btn-primary']) }}
			</div>
		</div>
	{{ Form::close() }}
</div>
@stop