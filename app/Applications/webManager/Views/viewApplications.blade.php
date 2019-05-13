@extends('layouts.template')
@section('pageTitle', 'Application Details')
@section('content')

<div class="animated fadeIn">
	<div class='row' >

		<div class='col-md-6'>
			<div class='card card-widget widget-user-2'>
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class='widget-user-header bg-blue'>
					<div class='widget-user-image'>
						<img class='img-circled' src='{{asset($app->iconPath)}}' alt='Icon'>
					</div>
					<!-- /.widget-user-image -->
					<h3 class='widget-user-username'> {{$app->name}} </h3>
					<h5 class='widget-user-desc'>Author:  {{$app->author}} </h5>
				</div>
				<div class='card-footer no-padding'>
					<ul class='nav flex-column'>
						<li class='list-group-item'>Description: &nbsp; <i>{{$app->description}}</i>  </li>
						<li class='list-group-item'>Folder Name: <span class='pull-right '> &nbsp;{{$app->location}}</span></li>
						<li class='list-group-item'>Total Users: <span class='pull-right '>   {{$totalUsers}}  </span></li>
						<li class='list-group-item'>Total Groups: <span class='pull-right '>    {{ $totalApplicationsInGroup or 0 }}  </span></li>
						<li class='list-group-item'>Included in Groups: &nbsp; <i>
							@if(isset($applicationsInGroup))
								@foreach($applicationsInGroup as $grp)
									{{ $loop->first ? '' : ', ' }}
									{{$grp->name}}
								@endforeach
							@endif
							</i>
						</li>
					</ul>
				</div>
			</div>
		</div>



		<div class='col-md-6'>
			<div class='card   card-success   '>
				<div class='card-header with-border  '>
					<h3 class='card-title '>Add Access</h3>

				</div>
				<form id='form1' name ='form1' method="post" action="{{route('addGroupToApplication')}}">
					<div class='card-body  '>
						 <ul class='nav flex-column'>
								<li>

									<div class='form-group'>
								   <label> Add Access to Group   </label>
									  <select class='form-control' name='groupId'>
										  @if(isset($applicationsNotInGroup))
											@foreach($applicationsNotInGroup as $anig)
												<option value='{{$anig->id}}'> {{$anig->name}} </option>
											@endforeach
										  @endif

									  </select>
									</div>

								 </li>
								{{ csrf_field() }}
								<input type="hidden" name='applicationId' value="{{$app->id}}">
								<input type="submit" value="Grant Access" class="btn btn-success btn-block">




							</ul>
					</div>
				</form>


			</div>

			<div class='card   card-danger  '>
				<div class='card-header with-border  '>
					<h3 class='card-title '>Remove Access</h3>

				</div>
				<form id='form2' name ='form2' method="post" action="{{route('removeGroupFromApplication')}}">
					<div class='card-body   '>
						 <ul class='nav flex-column'>
								<li>
									<div class='form-group'>
									   <label> Revoke Access to Group   </label>
										  <select class='form-control' name='groupId'>
											@if(isset($applicationsInGroup))
											  @foreach($applicationsInGroup as $groups)
												<option value='{{$groups->id}}'>{{$groups->name}}</option>
											  @endforeach
											@endif


										  </select>
									</div>



								</li>
								{{ csrf_field() }}
								<input type="hidden" name='applicationId' value="{{$app->id}}">
								<input type="submit" value="Remove Access" class="btn btn-danger btn-block">

							</ul>
					</div>
				</form>
			</div>




		</div>


	</div>
</div>

 
 
@endsection
