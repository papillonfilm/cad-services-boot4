@extends( 'layouts.template' )
@section('pageTitle', 'Mail Detail')
@section( 'content' )
	<div class="animated fadeIn">
		<div class='row'>
			<div class='col-md-12'>
				<div class='card  card-solid'>
					<div class='  card-body'>
						<ul class='nav flex-column'>
							<li class='list-group-item'> Date Sent: <span class='pull-right'>   {{$log->created_at}} </span></li>
							<li class='list-group-item'> Email To: <span class='pull-right'>    {{$log->email}} </span></li>
							<li class='list-group-item'> Email From: <span class='pull-right'>  {{$log->fromEmail}} </span></li>
							<li class='list-group-item'> Subject: <span class='pull-right'>     {{$log->subject}}  </span></li>
							<li class='list-group-item'> Opened Times: <span class='pull-right'>{{$log->openedTimes}} </span></li>
							<li class='list-group-item'> Last Opened Date: <span class='pull-right'>{{$log->lastOpenedDate}} </span></li>
							<li class='list-group-item'> IP Address: <span class='pull-right'>  {{$log->ip}} </span></li>
							<li class='list-group-item'> User Agent: <span class='pull-right'>  {{$log->userAgent}} </span></li>
							<li class='list-group-item'> Message: <br><span  > {!! $email !!} </span>

								<br>
								<span style="float:right">
									<a href="{{route('resendEmail', $log->id)}}" id="btn" class="btn btn-primary"  ><i class="fa fa-paper-plane"></i> Re-Send Email</a>
								</span>


							</li>

						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection