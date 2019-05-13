@extends('layouts.template')
@section('pageTitle', 'User Details')
@section('content')

	<div class="animated fadeIn">
		<div class='row' >

			<div class='col-md-6'>
				<div class='card card-widget widget-user-2'>

					<div class='widget-user-header bg-blue'>
						<div class='widget-user-image'>
							<img class='img-circle' src='{{asset($user->profilePicture)}}' alt='User Avatar'>
						</div>

						<h3 class='widget-user-username'> {{$user->name}} {{$user->initial}} {{$user->lastname}} {{$user->lastname2}} </h3>
						<h5 class='widget-user-desc'> {{$user->email}} </h5>
					</div>
					<div class='card-footer no-padding'>
						<ul class='nav flex-column'>
							<li class='list-group-item''>Gender: <span class='pull-right '>    {{$user->gender or 'not specified'}} &nbsp;
							<i class='fa
									  @if($user->gender == 'M')
										fa-mars
									  @elseif($user->gender == 'F')
										fa-venus
									  @endif

									'> </i></span></li>
							<li class='list-group-item'>Mobile: <span class='pull-right '> {{$user->mobile}} &nbsp; <i class='fa fa-mobile'></i></span></li>
							<li class='list-group-item'>Phone: <span class='pull-right '> {{$user->phone}} &nbsp; <i class='fa fa-phone'></i></span></li>
							<li class='list-group-item'>Join: <span class='pull-right '> {{date("j-M-Y", strtotime($user->created_at))}} &nbsp; <i class='fa fa-calendar'></i></span></li>
							<li class='list-group-item'>Last Login: <span class='pull-right '> {{date("j-M-Y", strtotime($user->lastLogin))}}  &nbsp; <i class='fa fa-calendar'></i></span></li>
							<li class='list-group-item'>Account Enable: <span class='pull-right '> {{$user->accountEnable==1?'Yes':'No' }} &nbsp; <i class="fa {{$user->accountEnable==1?'fa-check':'fa-close' }}  "> </i> </span></li>
							<li class='list-group-item'>Account Enable Date: <span class='pull-right '> {{date("j-M-Y g:i A", strtotime($user->enableOnDate)) }} &nbsp; <i class="fa fa-calendar }}  "> </i> </span></li>
							<li class='list-group-item'>Account Disable Date: <span class='pull-right '> {{date("j-M-Y g:i A", strtotime($user->disableOnDate)) }} &nbsp; <i class="fa fa-calendar"> </i> </span></li>

							<li class='list-group-item'>Total Apps: <span class='pull-right '> {{$totalApps or 0}} &nbsp; <i class='fa fa-th-large'></i></span></li>
							<li class='list-group-item'>Groups: <span class='pull-right '> {{$totalGroups}} &nbsp; <i class='fa fa-users'></i></span></li>
						</ul>

					</div>
				</div>


				<div class='card   card-solid  '>
					<div class='card-header with-border  '>
						<h3 class='card-title '>Applications with Access</h3>

					</div>
					<div class='card-body no-padding '>
						<ul class='nav flex-column'>
							<li class='list-group-item'>Applications: &nbsp; <i>
									@if(isset($applications))
										@foreach($applications as $app)
											{{ $loop->first ? '' : ', ' }}
											{{$app->name}}
										@endforeach
									@endif

								</i></span></li>
							<li class='list-group-item'> </li>
						</ul>
					</div>

				</div>

			</div>



			<div class='col-md-6'>

				<div class='card   card-solid  '>
					<div class='card-header with-border  '>
						<h3 class='card-title '>Groups Membership</h3>

					</div>
					<div class='card-body no-padding '>
						<ul class='nav flex-column'>
							<li class='list-group-item'>Groups: &nbsp; <i>
									@if(isset($groups))
										@foreach($groups as $g)
											{{ $loop->first ? '' : ', ' }}
											{{$g->name}}
										@endforeach
									@endif
								</i> </li>
							<li class='list-group-item'> </li>


						</ul>
					</div>

				</div>


				<div class='card   card-success   '>
					<div class='card-header with-border  '>
						<h3 class='card-title '>Add to Group</h3>

					</div>
					<form id='form1' name ='form1' method="post" action="{{route('addUserToGroup')}}">
						<div class='card-body  '>
							<ul class='nav flex-column'>
								<li>

									<div class='form-group'>
										<label> Add Access to Group   </label>

										<select class='form-control' name='groupId'>
											@if(isset($notInGroups))
												@foreach($notInGroups as $nig)
													<option value='{{$nig->id}}'> {{$nig->name}} </option>
												@endforeach
											@endif

										</select>
									</div>

								</li>
								{{ csrf_field() }}
								<input type='hidden' value='{{$user->id}}' name='userId'  >
								<input type="submit" value="Add To Group" class="btn btn-success btn-block">




							</ul>
						</div>
					</form>
				</div>

				<!-- remove -->

				<div class='card   card-danger  '>
					<div class='card-header with-border  '>
						<h3 class='card-title '>Remove from Group </h3>

					</div>
					<form id='form2' name ='form2' method="post" action="{{route('removeUserFromGroup')}}">
						<div class='card-body   '>
							<ul class='nav flex-column'>
								<li>
									<div class='form-group'>
										<label> Remove User from Group  </label>

										<select class='form-control' name='groupId'>
											@if(isset($groups))
												@foreach($groups as $g)
													<option value='{{$g->id}}'> {{$g->name}} </option>
												@endforeach
											@endif

										</select>
									</div>



								</li>
								{{ csrf_field() }}
								<input type='hidden' value='{{$user->id}}' name='userId'  >
								<input type="submit" value="Remove From Group" class="btn btn-danger btn-block">

							</ul>
						</div>
					</form>


				</div>

				<div class='card   card-warning  '>
					<div class='card-header with-border  '>
						<h3 class='card-title '>User Permisions</h3>

					</div>
					<form id='form3' name ='form3' method="post" action="{{  route('user.permissions')  }}">
						<div class='card-body   '>

							{{ csrf_field() }}
							<input type='hidden' value='{{$user->id}}' name='userId'  >
							<input type="submit" value="Manage Permissions" class="btn btn-warning btn-block">
					</form>
				</div>
				</form>


			</div>


			<!-- end Remove box -->



		</div>






	</div>

		 
@endsection
