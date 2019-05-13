@extends('layouts.template')
@section('pageTitle', 'Message Center')
@section('content')

<div class="animated fadeIn">
	<div class='card card-solid '>
		<div class='card-header with-border'>
			<h3 class='card-title'>  Message </h3>
			<a href='{{route('addMessage')}}' class='btn btn-sm btn-success '  style='float:right'>Add Message</a>
		</div>
		<div class='card-body'>
		 <table id="table" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th data-priority="1"> Name </th>

							<th> Start Date </th>
							<th> End Date </th>
							<th> Show Times</th>
							<th> Showed Times</th>
							<th style="width: 70px;" data-priority="2"> Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($messages as $m)
						<tr>
							<td><a href="{{route('messageDetail', $m->id  )}}" >{{$m->name}}   </a></td>





							<td> {{ \Carbon\Carbon::parse($m->startDate)->format("Y-m-d") }} </td>
							<td> {{ \Carbon\Carbon::parse( $m->endDate )->format("Y-m-d") }} </td>
							<td> {{ $m->showTimes }} </td>
							<td> {{ $m->showedTimes }} </td>
							<td>

								<div class="btn-group" style="min-width: 69px;">
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="{{route('editMessage', $m->id )}}"><i class="fa fa-pencil"></i> Edit</a>
											<a class="dropdown-item" href="{{route('deleteMessage', $m->id )}}"><i class="fa fa-trash"></i> Delete</a>
										</div>
									</div>
								</div>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>



		</div>
	</div>
</div>
		
 
 
@endsection

@section( 'javascript' )
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#table').DataTable({
			'pageLength':50,
			'responsive':true
		});
		
		
	});
	
</script>
@endsection
 