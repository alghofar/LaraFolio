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

				@if(Auth::guest())
					<li ><a href="{{ route('users.getRegister') }}">Register</a></li>
					<li><a href="{{ route('sessions.getLogin') }}">Login</a></li>
				@else
					<li><a href="{{ route('users.getProfile') }}">My profile</a></li>
					<li><a href="{{ route('sessions.getLogout') }}">Logout</a></li>
				@endif

			</ul>

			<ul class="nav navbar-nav navbar-right">
				@if(Auth::guest())
					<li><a href="{{ url('register') }}" class="btn btn-primary">Register</a></li>
					<li><a href="{{ url('login') }}" class="btn btn-primary">Login</a></li>
				@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class="{{( Request::segment('1') == 'user' && Request::segment('2') == '' ? 'active' : false )}}"><a href="{{ url('user')}}">My tricks</a></li>
						<li class="{{( Request::segment('2') == 'favorites' ? 'active' : false )}}"><a href="{{ url('user/favorites')}}">My Favorites</a></li>
						<li class="{{( Request::segment('2') == 'settings' ? 'active' : false )}}"><a href="{{ url('user/settings')}}">Settings</a></li>
						<li><a href="{{ url('logout')}}">Logout</a></li>
					</ul>
				</li>
				@endif
			</ul>
		</div>
	</div>
</div>