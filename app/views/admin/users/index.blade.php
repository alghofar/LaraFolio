@section('title','Viewing users')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-12"> 
			<div class="page-header">
			  <h1>Showing all users ({{Tyloo\User::count()}})</h1>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12"> 
			<table class="table table-bordered">
			   	<thead>
			    	<tr>
				     	<th>Avatar</th>
						<th>Username</th>
						<th>Email</th>
						<th>Full Name</th>
						<th>Location</th>
						<th>Group</th>
						<th>Suspended?</th>
						<th>Registration Date</th>
						<th>Actions</th>
			    	</tr>
			   	</thead>
			   	<tbody>
				  	@foreach($users as $user)
				    <tr>
				    	<td><img src="{{ $user->avatar }}" class="img-rounded avatar"></td>
				        <td><a href="{{ url($user->username) }}" target="_blank">{{ $user->username }}</a></td>
				       	<td>{{ $user->email }}</td>
				       	<td>{{ $user->fullName }}</td>
				       	<td>{{ $user->location }}</td>
				       	<td>{{ $user->group }}</td>
				       	<td>{{ $user->suspended }}</td>
				       	<td>{{ $user->created_at }}</td>
				       	<td><a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-xs">Edit</a> <a href="{{ URL::route('admin.users.suspend', $user->id) }}" class="btn btn-primary btn-xs">Suspend</a> <a href="{{ URL::route('admin.users.delete', $user->id) }}" class="btn btn-primary btn-xs">Delete</a></td>
				     </tr>
				    @endforeach
			    </tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="text-center">{{ $users->links(); }}</div>
		</div>
	</div>
</div>
@stop