@extends('layouts.template')
@section('pageTitle', 'Route Details')
@section('content')

<div class="animated fadeIn">
	<div class='row' >


		<div class='col-md-12'>
			<div class='card card-widget  '>
				<!-- Add the bg color to the header using any of the bg-* classes -->

				<div class='card-footer no-padding'>
					<ul class='nav flex-column'>

						<li class='list-group-item'>Application Name: &nbsp; <span class='pull-right '>  {{$permission->applicationName}}    </span>  </li>
						<li class='list-group-item'>Url: &nbsp; <span class='pull-right '>  {{$permission->url}}    &nbsp; <i class='fa fa-key'></i></span>  </li>

						<li class='list-group-item'>Description: &nbsp; <i>{{$permission->description}} </i> </li>


						<li class='list-group-item'>Creation Date &nbsp; <span class='pull-right '>
							{{ \Carbon\Carbon::parse($permission->created_at)->format('j-M-Y')}} &nbsp; <i class='fa fa-calendar'></i></span>
						</li>



					</ul>

				</div>
			</div>
		</div>







	</div>
</div>
		

	 
 
@endsection
