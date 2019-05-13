<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.12
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('pageTitle') - {{ config('app.name') }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

	<!-- Icons-->
	<link href="{{ asset('node_modules/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('node_modules/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
	<link href="{{ asset('node_modules/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('node_modules/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

	<!-- Main styles for this application-->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">

	<!-- Datatables -->
	<!-- Data Tables new -->
	<!--link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">-->
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">
	<!-- Data Tables old -->
	<!--link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">-->

	<!-- VidalFramework Main CSS -->
	<!--link href="{{ asset('css/vfThemeWhite.css') }}" rel="stylesheet">-->
	<link href="{{ asset('css/vidalFramework.css') }}" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

	@yield('css')


	<!-- Global site tag (gtag.js) - Google Analytics-->
	<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
	<script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        // Shared ID
        gtag('config', 'UA-118965717-3');
        // Bootstrap ID
        gtag('config', 'UA-118965717-5');
	</script>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">

	<button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
		<span class="navbar-toggler-icon"></span>
	</button>
	<span class=" hidden-sm hidden-md hidden-lg " style="width: 45px; display: inline-block;"   >
		&nbsp;
	</span>

	<a class="navbar-brand logo logo-vf" href="/dashboard/">
		<span class=" hidden-sm hidden-md hidden-lg "><img alt="Logo" src="{{ asset('images/logoPage.svg') }}"   style="width:33%; max-width: 180px"  ></span>
		<span class=" hidden-xs "><img alt="Logo" src="{{ asset('images/logoPage.svg') }}" width="180px"  ></span>
	</a>

	<span class=" hidden-sm hidden-md hidden-lg " style="width: 30px; display: inline-block;"   >
		&nbsp;
	</span>


	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
		<span class="navbar-toggler-icon"></span>
	</button>

	@include('layouts.navigation')
    @include('layouts.loginBox')
	<!--button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
		<span class="navbar-toggler-icon"></span>
	</button>
	<button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
		<span class="navbar-toggler-icon"></span>
	</button>-->
</header>
<div class="app-body">


	@include('layouts.navigationMobile')

	<main class="main">
		<ol class="breadcrumb">
			<!-- Breadcrumb Menu-->
			<!--li class="nav-item px-3">
				<a class="nav-link" href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
			</li>
			<li class="nav-item px-3 dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
					<i class="fa fa-th-large"></i>&nbsp;<span> Apps</span> <span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">

					@foreach( getApplications() as  $category=>$apps)

						<li class='menuItemHeader' style="padding-left: 5px;"> {{$category}} </li>

						@foreach($apps as $app)
							<li>
								@if(\Route::getRoutes()->hasNamedRoute($app['location']))
									<a href='{{route($app['location'])}}' class="nav-link" style=";padding-left: 30px;padding-right: 30px">
										<img src="{{asset($app['iconPath'])}}" height="14px" > &nbsp;
										<span> {{$app['name']}}</span>
									</a>

							@if(isset($subNavigation[$app['name']]))


								@foreach($subNavigation[$app['name']] as $nav)
									<li class='nav-link menu-item treeview' style="list-style: none; padding-left: 40px">
										<a href="{!! $nav['link'] !!}" style="color:#666 " >
											<i class='fa fa-angle-right' style="width: 10px;margin-right: 0px; "></i>  {{$nav['title']}}
										</a>
									</li>
								@endforeach


							@endif

							@else
								<a href='#noRoute' class="nav-link" style=";padding-left: 30px">
									<img src="{{asset($app['iconPath'])}}" height="14px" > &nbsp;
									<span> {{$app['name']}}</span>
								</a>
								@endif
								</li>
								@endforeach

								@if($loop->last)

								@else
									<li class='dropdown-divider'>   </li>
								@endif
								@endforeach


				</ul>
			</li>-->
			<li><h4>@yield('pageTitle')</h4></li>
			{!! breadcrumb() !!}
		</ol>

		<div class="container-fluid">

			<!-- Main content -->
			<section class="content">
				<!-- Flash Message -->
				<div class="flash-message" id='flashMessage'>


					@foreach (['danger', 'warning', 'success', 'info', 'error', 'message'] as $msg)
						@if(Session::has('alert-' . $msg))
							<p class="alert alert-{{ $msg }}">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								{!! Session::get('alert-' . $msg) !!}

							</p>
						@endif
					@endforeach
				</div>
				<!-- End Flash Message -->

				<!-- Errors -->
				@if ($errors->any())
					<div class="" id='errorMessage'>

						@foreach ($errors->all() as $error)
							<p class="  alert alert-danger "> {{$error}}
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							</p>
						@endforeach

					</div>
			@endif
			<!-- End Errors -->



			@yield('content')

			<!-- /.box -->
			</section>

		</div>
	</main>

</div>
<footer class="app-footer">
	<!-- Copyright Info --> &copy; {{ date("Y") }}
</footer>

<!--from datatables bootstrap4-->
<!--script src="https://code.jquery.com/jquery-3.3.1.js" ></script>-->
<!-- CoreUI and necessary plugins-->
<script src="{{ asset('node_modules/jquery/dist/jquery.min.js') }}" ></script>
<script src="{{ asset('node_modules/popper.js/dist/umd/popper.min.js') }}" ></script>
<script src="{{ asset('node_modules/bootstrap/dist/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('node_modules/pace-progress/pace.min.js') }}" ></script>
<script src="{{ asset('node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}" ></script>
<script src="{{ asset('node_modules/@coreui/coreui/dist/js/coreui.min.js') }}" ></script>

<!-- Plugins and scripts required by this view-->
<script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}" ></script>
<script src="{{ asset('node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}" ></script>
<!-- SlimScroll old -->
<script src="{{ asset('js/slimScroll/jquery.slimscroll.min.js') }}" ></script>
<!-- FastClick  old -->
<script src="{{ asset('js/fastclick/fastclick.js') }}" ></script>
<!-- Main App -->
<script src="{{ asset('js/main.js') }}" ></script>
<!-- Data Tables new -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" ></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" ></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js" ></script>
<!-- Data Tables old -->
<!--script src="{{ asset('js/jquery.dataTables.min.js') }}" ></script>-->
<!--script src="{{ asset('js/dataTables.bootstrap.min.js') }}" ></script>-->
<!--script src="{{ asset('js/dataTables.responsive.js') }}" ></script>
<script src="{{ asset('js/responsive.bootstrap.min.js') }}" ></script>-->

@foreach (['danger','warning','success','info', 'error'] as $msg)
	@if (Session::has('alert-' . $msg))
		<script type="text/javascript">
            $(document).ready(function($){
                $("#flashMessage").delay(5000).slideUp(500);
            });

		</script>

		@break
	@endif
@endforeach
@if ($errors->any())
	<script type="text/javascript">
        $(document).ready(function($){
            $("#errorMessage").delay(5000).slideUp(500);
        });

	</script>

@endif

@if (Auth::check() and session('rememberMe') !=1)
	<script>
        var timeout = ({{config('session.lifetime')}} * 60000) +3 ;
        setTimeout(function(){
            window.location.reload(1);
        },  timeout);

	</script>
@endif

@yield('javascript')

<script type="text/javascript">

    function readNotification(id, object){
        var total ;

        $(object).parent().fadeOut();
        total = parseInt($("#notificationTotal").html());

        //alert(total);

        total --;

        //alert(total);
        if(total == 0){
            $(".notificationTotal").fadeOut();
        } else{
            $(".notificationTotal").html(total);
        }

		@if(Route::getRoutes()->hasNamedRoute('updateNotification'))
        $.ajax({
            method: "GET",
            url: "{{ route('updateNotification') }}/"+id+"/",
            cache: false
        });


		@endif



    }

</script>

</body>
</html>




