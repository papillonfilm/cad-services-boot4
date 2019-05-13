@extends('layouts.template')
@section('pageTitle', 'Sudo')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Users </h3>
			</div>
			<div class='card-body'>
				<table id="tableUsers" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th data-priority="1"> Name </th>
							<th> Email </th>
							<th width='30px' data-priority="2" > Sudo </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td>{{$user->name}} {{$user->initial}} {{$user->lastname}} {{$user->lastname2}}</td>
							<td>{{$user->email}}</td>
							<td align="center">
								<a href="{{route('sudoInto',[$user->id])}}" class="btn  btn-secondary btn-xs"><i class="fa fa-hashtag"></i> Sudo </a>

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