@extends('layouts.template')
@section('pageTitle', 'Enable Accounts')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Local Users </h3>

			</div>
			<div class='card-body'>
				<table id="tableUsers" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th data-priority="1"> Name </th>
							<th> Email </th>
							<th data-priority="2" > Disable </th>

					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td> {{$user->name}} {{$user->initial}} {{$user->lastname}} {{$user->lastname2}} </td>
							<td>{{$user->email}}</td>
							<td align="center"><a href='{{route('adDisableAccount',$user->id)}}' class='btn btn-xs btn-danger'> Disable </a></td>
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