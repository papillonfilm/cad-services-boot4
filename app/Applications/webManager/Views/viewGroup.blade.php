@extends('layouts.template')
@section('pageTitle', 'Group Details')
@section('content')

<div class="animated fadeIn">
	<div class='row' >


		<div class='col-md-6'>
			<div class='card card-widget widget-user-2'>
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class='widget-user-header bg-blue'>

					<!-- /.widget-user-image -->
					<h3 > {{$group->name}} </h3>

				</div>
				<div class='card-footer no-padding'>
					<ul class='nav flex-column'>
						<li class='list-group-item'>Description: &nbsp; <i>{{$group->description}} </i> </li>
						<li class='list-group-item'>Created by &nbsp; <span class='pull-right '>  {{$user->name or ''}} {{$user->initial or ''}} {{$user->lastname or ''}} {{$user->lastname2 or ''}}    &nbsp; <i class='fa fa-user'></i></span></li>
						<li class='list-group-item'>Permission Priority: &nbsp; <span class='pull-right '>  {{$group->permissionPriority}}    &nbsp; <i class='fa fa-key'></i></span>  </li>
						<li class='list-group-item'>Creation Date &nbsp; <span class='pull-right '>  {{ \Carbon\Carbon::parse($group->created_at)->format('j-M-Y')}} &nbsp; <i class='fa fa-calendar'></i></span></li>
						<li class='list-group-item'>Total Users <span class='pull-right '>  {{$totalUsers}}    &nbsp; <i class='fa fa-users'></i></span></li>
						<li class='list-group-item'>Total Applications <span class='pull-right '>  {{$totalApplications}}     &nbsp; <i class='fa fa-th-large'></i></span></li>
						<li class='list-group-item'>Applications:<i>
						@foreach($applicationsInGroup as $app  )
							{{ $loop->first ? '' : ',  ' }}
							{{$app->name}}
						@endforeach


							</i>&nbsp; <i>  </i></li>

					</ul>

				</div>
			</div>
		</div>



		<div class='col-md-6'>
			<div class='card   card-success   '>
				<div class='card-header with-border  '>
					<h3 class='card-title '>Add Application</h3>

				</div>
				<form id='form1' name ='form1' action="{{route('addApplicationToGroup')}}" method="post">
					<div class='card-body  '>
						 <ul class='nav flex-column'>
								<li>

									<div class='form-group'>
								   <label> Add Application to Group   </label>
								   <input type='hidden' value='{{$group->id}}' name='groupId'  >
									  <select class='form-control' name='applicationId'>
										@foreach($applicationsNotInGroup as $app  )
											<option value="{{$app->id}}" >{{$app->name}}</option>
										@endforeach
									  </select>
									</div>

								 </li>
								{{ csrf_field() }}
								<input type="submit" value="Add Application" class='btn btn-success btn-block'>




							</ul>
					</div>
				</form>


			</div>

			<div class='card   card-danger  '>
				<div class='card-header with-border  '>
					<h3 class='card-title '>Remove Application</h3>

				</div>
				<form id='form2' name ='form2' method="post" action="{{route('removeApplicationFromGroup')}}">
					<div class='card-body   '>
						 <ul class='nav flex-column'>
								<li>
									<div class='form-group'>
									   <label> Remove Applicarion from Group   </label>
									   <input type='hidden' value='{{$group->id}}' name='groupId'  >
										  <select class='form-control' name='applicationId'>
											@foreach($applicationsInGroup as $app  )
												<option value="{{$app->id}}" >{{$app->name}}</option>
											@endforeach
										  </select>
									</div>



								</li>
								 {{ csrf_field() }}
								<input type="submit" value="Remove Application" class='btn btn-danger btn-block'>

							</ul>
					</div>
				</form>


			</div>



			<div class='card   card-warning  '>
				<div class='box-header with-border  '>
					<h3 class='card-title '>Application Permisions</h3>

				</div>
				<form id='form3' name ='form3' method="post" action="{{  route('group.permissions')  }}">
					<div class='card-body   '>

						{{ csrf_field() }}
						<input type='hidden' value='{{$group->id}}' name='groupId'  >
						<input type="submit" value="Manage Permissions" class="btn btn-warning btn-block">
						</form>
					</div>
				</form>


			</div>



		</div>



	</div>
</div>
		

	 
 
@endsection
