@if(Session::get('errors'))
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>There were errors during registration:</strong>
	@foreach($errors->all('<li>:message</li>') as $message)
		{{$message}}
	@endforeach
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ trans('pages.flash.success') }}</strong>
	{{ $message }}
</div>
@endif
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ trans('pages.flash.error') }}</strong>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ trans('pages.flash.warning') }}</strong>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	{{ trans('pages.flash.info') }}</strong>
	{{ $message }}
</div>
@endif