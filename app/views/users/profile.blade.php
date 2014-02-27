@section('title','Profile')

@section('content')
<div class="container">

	<div class="row push-down">
		<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
			<h1 class="page-title">My tricks </h1>
		</div>
		<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 text-right">
			<a href="{{ url('user/tricks/new')}}" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Create new</a>
		</div>
	</div>

	@include('tricks.grid', [ 'tricks' => $tricks ])
</div>
@stop
