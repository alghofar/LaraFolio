@section('title', 'Login' . trans('main.website.separator') . trans('main.website.title'))

@section('content')
	<div class="row">
		{{ Form::open(['route' => 'auth.postLogin', 'method' => 'POST', 'class' => 'form-signin', 'role' => 'form']) }}
			<h2>Please sign in</h2>
			{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username or Email']) }}
			{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
			<label class="checkbox">
				{{ Form::checkbox('remember', 1) }} Remember me
			</label>
			<button class="btn btn-primary btn-block" type="submit">Sign in</button>
		{{ Form::close() }}
	</div>
@stop