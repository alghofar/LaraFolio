@section('title', 'Edit the User \'' . $user->username . '\'' . trans('main.website.separator') . trans('main.website.title'))

@section('content')
	<div class="row">
		<h1 class="page-title">Edit the User '{{ $user->username }}'</h1>

		<div class="col-lg-8 col-lg-push-2">
			{{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'class' => 'form-horizontal', 'role' => 'form']) }}
				{{ Form::hidden('id') }}
				@include('admin.users._form', ['submit_button' => trans('buttons.admin.users.edit.submit')])
				}
			{{ Form::close() }}
		</div>
	</div>
@stop