@extends('layouts.template')
@section('pageTitle', 'Imported Users from AD')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Imported Ad Users </h3>

			</div>
			<div class='card-body'>
				<table id="tableUsers" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th> Name </th>
							<th> Email </th>

					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td> {{$user->name}} {{$user->initial}} {{$user->lastname}} {{$user->lastname2}} </td>
							<td>{{$user->email}}</td>

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