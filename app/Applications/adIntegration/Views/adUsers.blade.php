@extends('layouts.template')
@section('pageTitle', 'AD Users')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='box-header with-border'>
				<h3 class='card-title'>  LDAP Users </h3>

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
							<td> {{$user['name']}} {{$user['initial'] or ''}} {{$user['lastname'] or ''}} {{$user['lastname2'] or ''}} </td>
							<td>{{$user['email']}}</td>
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