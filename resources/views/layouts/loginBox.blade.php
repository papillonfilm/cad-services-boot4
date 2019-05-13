@if (Auth::check())

	<ul class="nav navbar-nav ml-auto">
		<!-- notifications -->
	@include('layouts.notifications')

	<!-- User Account Menu -->
		<li class="nav-item dropdown user user-menu">
			<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img class="img-avatar" src="{{ asset(Auth::user()->profilePicture)  }}" alt="">
				<span class="hidden-xs">{{ Auth::user()->name}} {{ Auth::user()->lastname }} </span>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="dropdown-header text-center">
					<img src="{{ asset(Auth::user()->profilePicture)  }}" class="img-circle" alt="User Image">
					<p>
						{{ Auth::user()->name}} {{ Auth::user()->lastname}}<br />
						<small>Last Login: {{   date ("j-M-Y g:i a",strtotime(Auth::user()->lastLogin  )) }}</small>
					</p>
				</div>
				<a href="{{route('logout')}}" class="dropdown-item btn btn-default btn-flat btn-block">
					<i class="fa fa-lock"></i> Sign out</a>
			</div>
		</li>


	</ul>


@else
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">

			<li class="dropdown user user-menu">
				<a href="/login" class=" " data-toggle=" " style="display:inline-block;">
					<span  ><i class="fa fa-sign-in"></i> </span>
				</a>
			</li>
		</ul>
	</div>
@endif