<?php
	$notifications = notifications();
?>


@if($notifications['access'] == 1)

		<li class="nav-item dropdown d-md-down-none">
			<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="icon-bell"></i>
				@if($notifications['total'] > 0)
					<span class="badge badge-pill badge-danger notificationTotal" id='notificationTotal' >{{ $notifications['total'] }}</span>
				@endif
    		</a>

			<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
			@if( $notifications['total'] > 0 )

				<!--div class="dropdown-header text-center">
					<strong>You have {{ $notifications['total'] }} notifications</strong>
				</div>-->



				@foreach($notifications['notifications'] as $alert)

					<!--div style="font-size: 11px; text-align: right;color: #969696;  "  >
						<i>{{ date("j-M-Y g:i a",strtotime($alert['created_at'])) }}</i>
					</div>
					<a class="dropdown-item" href="#">
						<i class="icon-user-follow text-success"></i> {{ $alert['notification'] }}</a>-->




					<div  class= "notificationList" style="padding-left: 10px;padding-top: 0px;">
						<a href="#" class="close" style='float: right; opacity.4; ' onClick="readNotification({{$alert['id']}}, this)" >×</a>
						<div style="font-size: 11px; text-align: right;color: #969696;  "  >
							<i>{{ date("j-M-Y g:i a",strtotime($alert['created_at'])) }}</i>
						</div>
						<i class="icon-user-follow text-success"></i> {{ $alert['notification'] }} <br>

					</div>




		@endforeach


			@else
				<div class="dropdown-header text-center">
					<strong>No New Notifications</strong>
				</div>



			@endif
				<a class="dropdown-header text-center " href="{{route('notifications')}}">
					View all notifications</a>


			</div>


    </li>
@endif