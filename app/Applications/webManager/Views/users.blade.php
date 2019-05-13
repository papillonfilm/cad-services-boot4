@extends('layouts.template')
@section('pageTitle', 'Users')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Users </h3>
				<a href='{{route('addUser')}}' class='btn btn-sm btn-success '  style='float:right'>Add User</a>
			</div>
			<div class='card-body'>
				<table id="tableUsers" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th data-priority="1"> Name </th>
							<th> Email </th>
							<th width='50px' data-priority="2"> Action </th></tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td><a href="{{route('userDetail',['id'=>$user->id])}}" >{{$user->name}} {{$user->initial}} {{$user->lastname}} {{$user->lastname2}}</a></td>
							<td>{{$user->email}}</td>
							<td align="center">

								<div class="btn-group" style="min-width: 69px;">
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="{{route('editUser', $user->id)}}"><i class="fa fa-pencil"></i> Edit</a>
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
@section('javascript')

<script type="text/javascript"  >
	 
	$(document).ready(function(){

		$('#tableUsers').DataTable({
			'pageLength':50,
			'responsive':true
		});
		
	});
	
</script>
@endsection