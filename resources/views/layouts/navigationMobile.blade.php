

@if (Auth::check())
	<div class="sidebar">
		<nav class="sidebar-nav">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="{{route('dashboard')}}">
						<i class="nav-icon icon-speedometer"></i> Dashboard
					</a>
				</li>
				@foreach( getApplications() as  $category=>$apps)
					<li class="nav-title">{{$category}}</li>
					@foreach($apps as $app)

						@if(\Route::getRoutes()->hasNamedRoute($app['location']))
							@if(isset($subNavigation[$app['name']]))
								<li class="nav-item nav-dropdown">
									<a class="nav-link nav-dropdown-toggle navIcons" href="{{route($app['location'])}}">
										<img src="{{asset($app['iconPath'])}}" height="14px" >
										<span> {{$app['name']}}</span></a>
									<!--i class="navIcons nav-icon icon-puzzle"></i>{{$app['name']}}</a>-->

									@foreach($subNavigation[$app['name']] as $nav)
										<ul class="nav-dropdown-items">
											<li class="nav-item">
												<a class="nav-link" href="{!! $nav['link'] !!}">
													<i class='fa fa-angle-right' style="width: 10px"></i>{{$nav['title']}} </a>
											</li>
										</ul>
									@endforeach
								</li>
							@else
								<li class="nav-item">
									<a class="nav-link" href="{{route($app['location'])}}">
										<img src="{{asset($app['iconPath'])}}" class="navIcons" height="14px" >
										<span> {{$app['name']}}</span></a>
										<!--i class="nav-icon icon-puzzle"></i>{{$app['name']}}</a>-->
								</li>
							@endif

						@endif



					@endforeach

				@endforeach
			</ul>
		</nav>
		<button class="sidebar-minimizer brand-minimizer" type="button"></button>
	</div>

@else

<ul class='sidebar-menu'>
	<li>   <a href='{{route('login')}}'><i class="fa fa-sign-in">  </i> <span>Login</span> </a>  </li>
</ul>

@endif