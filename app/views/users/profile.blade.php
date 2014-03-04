@section('title', 'My Profile' . trans('main.website.separator') . trans('main.website.title'))

@section('content')
	<div class="row">
		<h1 class="page-title">My Profile</h1>

		<div class="col-lg-8 col-lg-push-2">
			{{ Form::model($user, ['route' => 'users.postProfile', 'method' => 'POST', 'class' => 'form-horizontal', 'role' => 'form']) }}
				<div class="form-group">
					{{ Form::label('username', trans('users.create.form.username.label'), ['class' => 'col-sm-3 control-label']) }}
					<div class="col-sm-9">
						<div class="input-group">
							{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.username.placeholder'), 'disabled' => 'disabled']) }}
						<span class="input-group-btn">
							{{ link_to_route('users.getSettings', 'Change it!', null, ['class' => 'btn btn-primary']) }}
						</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('email', trans('users.create.form.email.label'), ['class' => 'col-sm-3 control-label']) }}
					<div class="col-sm-9">
						{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('users.create.form.email.placeholder'), 'disabled' => 'disabled']) }}
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