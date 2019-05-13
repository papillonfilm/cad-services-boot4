@extends('layouts.template')
@section('pageTitle', 'AD Integration')
@section('content')

	<div class="animated fadeIn">

		<div class='card card-solid'>
			<div class='card-header with-border'>
				<h3 class='card-title'> Local Database </h3>
			</div>
			<div class='card-body'  >
				<div class='row'>

					<div class='col-md-4 col-sm-6 col-xs-12'>
						<div class='info-box bg-blue'>
							<a href='{{route('localUsers')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-user'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Local Users </span>
									<span class='info-box-number text-white'> {{$totalLocalUsers}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>

					<div class='col-md-4 col-sm-6 col-xs-12'>
						<div class='info-box bg-green'>
							<a href='{{route('enableAccounts')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-user'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Enabled Accounts </span>
									<span class='info-box-number text-white'> {{$totalActiveAccounts}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>

					<div class='col-md-4 col-sm-6 col-xs-12'>
						<div class='info-box bg-red'>
							<a href='{{route('disableAccounts')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-user'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Disabled Accounts </span>
									<span class='info-box-number text-white'> {{$totalDisableAccounts}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>

				</div>



			</div>

		</div>

		<!-- ldap data -->
		<div class='card card-solid'>
			<div class='card-header with-border'>
				<h3 class='card-title'> LDAP (Active Directory)</h3>
			</div>
			<div class='card-body'  >

				<div class='row'>

					<!-- Total Users -->
					<div class='col-md-3 col-sm-6 col-xs-12'>
						<div class='info-box bg-blue'>
							<a href='{{route('adUsers')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-address-book'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>AD Users</span>
									<span class='info-box-number text-white'> {{$totalAdUsers}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>

					<!-- Total Accounts IMPORTED -->
					<div class='col-md-3 col-sm-6 col-xs-12'>
						<div class='info-box bg-blue'>
							<a href='{{route('importedAdUsers')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-address-book'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Imported</span>
									<span class='info-box-number text-white'> {{$totalAdUsersInSystem}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>

					<!-- Total Accounts Disable -->
					<div class='col-md-3 col-sm-6 col-xs-12'>
						<div class='info-box bg-yellow'>
							<a href='{{route('adNotImported')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-address-book'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Not Imported</span>
									<span class='info-box-number text-white'> {{$totalAdUsersNotInSystem}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>


					<!-- accounts disable in ad that need to disable local -->
					<div class='col-md-3 col-sm-6 col-xs-12'>
						<div class='info-box bg-red'>
							<a href='{{route('usersNotInAd')}}' style="text-decoration: none">
								<span class='info-box-icon text-white'><i class='fa fa-address-book'></i></span>
								<div class='info-box-content'>
									<span class='info-box-text text-white'>Not in AD<br>Only Local System</span>
									<span class='info-box-number text-white'> {{$totalInSystemButNotAd}} </span>

									<span class='progress-description smallFont'>
									<span class='smallFont'> </span>
									</span>
								</div>

							</a>
						</div>
					</div>


				</div>

			</div>

		</div>
	</div>

@endsection