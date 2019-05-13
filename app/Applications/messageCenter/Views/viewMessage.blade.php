@extends( 'layouts.template' )
@section('pageTitle', 'Message Detail')
@section( 'content' )
	<div class="animated fadeIn">
		 <div class='row'>
			<div class='col-md-12'>
				<div class='card  card-solid'>
					<div class='  card-body'>
						<ul class='nav flex-column'>
							<li class='list-group-item'> Date: <span class='pull-right'> {{$message->created_at}}</span></li>
							<li class='list-group-item'> Name:<span class='pull-right'>{{$message->name}}</span></li>


							<li class='list-group-item'> Target:<span class='pull-right'> {{$target}}</span></li>


							<li class='list-group-item'> Start Date: <span class='pull-right'>{{$message->startDate}} </span></li>
							<li class='list-group-item'> End Date: <span class='pull-right'>{{$message->endDate}} </span></li>
							<li class='list-group-item'> Show Times:<span class='pull-right'> {{$message->showTimes}}</span></li>
							<li class='list-group-item'> Showed Times:<span class='pull-right'> {{$message->showedTimes}}</span></li>

							<li class='list-group-item'> Created Date:<span class='pull-right'> {{$message->created_at}}</span></li>

							<li class='list-group-item'> Message:<span class='pull-right'> {{$message->message}}</span></li>
						</ul>
					</div>
				</div>
			 </div>
		</div>
	</div>
	 
@endsection

@section( 'javascript' )

@endsection

@section( 'css' )

@endsection