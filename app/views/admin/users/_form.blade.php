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
	{{ Form::label('password_confirmation', trans('users.create.form.password_confirmation.label'), ['class' => 'col-sm-3 control-label']) }}
	<div class="col-sm-9">
		{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('users.create.form.password_confirmation.placeholder')]) }}
	</div>
</div>
<div class="form-group{{ ($errors->has('first_name')) ? ' has-error' : '' }}">
	{{ Form::label('first_name', trans('users.create.form.first_name.label'), ['class' => 'col-sm-3 control-label']) }}
	<div class="col-sm-9">
		{{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.first_name.placeholder')]) }}
	</div>
</div>
<div class="form-group{{ ($errors->has('last_name')) ? ' has-error' : '' }}">
	{{ Form::label('last_name', trans('users.create.form.last_name.label'), ['class' => 'col-sm-3 control-label']) }}
	<div class="col-sm-9">
		{{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.last_name.placeholder')]) }}
	</div>
</div>
<div class="form-group{{ ($errors->has('location')) ? ' has-error' : '' }}">
	{{ Form::label('location', trans('users.create.form.location.label'), ['class' => 'col-sm-3 control-label']) }}
	<div class="col-sm-9">
		{{ Form::text('location', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.location.placeholder')]) }}
	</div>
</div>
<div class="form-group{{ ($errors->has('description')) ? ' has-error' : '' }}">
	{{ Form::label('description', trans('users.create.form.description.label'), ['class' => 'col-sm-3 control-label']) }}
	<div class="col-sm-9">
		{{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.description.placeholder')]) }}
	</div>
</div>
<div class="form-group{{ ($errors->has('is_admin')) ? ' has-error' : '' }}">
	<div class="col-sm-offset-3 col-sm-9">
		<label class="checkbox">
			{{ Form::checkbox('is_admin', 1) }} Is Admin?
		</label>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
		{{ Form::reset(trans('buttons.reset'), ['class' => 'btn btn-default']) }}
		{{ Form::submit($submit_button, ['class' => 'btn btn-primary']) }}
	</div>
</div>