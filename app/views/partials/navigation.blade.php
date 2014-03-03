<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".header-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="{{ route('home') }}">
				{{ trans('main.website.title') }}
			</a>
		</div>

		<div class="collapse navbar-collapse header-collapse">
			<ul class="nav navbar-nav">
				{{ Navigation::make(Request::path()) }}
			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if(Auth::guest())
					<li><a href="{{ route('auth.getRegister') }}">Register</a></li>
					<li><a href="{{ route('auth.getLogin') }}">Login</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome back, {{ Auth::user()->username }} <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="{{ url('profile')}}">My profile</a></li>
						<li><a href="{{ route('auth.getLogout')}}">Logout</a></li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>