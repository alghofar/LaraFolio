@if(Session::get('errors'))
    <div class="container">
    	<div class="row">
	    	<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>There were errors during registration:</strong>
				@foreach($errors->all('<li>:message</li>') as $message)
					{{$message}}
				@endforeach
			</div>
	    </div>
	</div>
@endif
@if(Session::has('first_use'))
	<div class="alert alert-success alert-dismissable text-center">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4>Welcome to LaraFolio!</h4>
		<p>Get into the awesomeness!</p>
	</div>
@endif