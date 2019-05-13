@extends('layouts.template')
@section('pageTitle', 'Permissions')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Routes (Urls) </h3>
				<span style='float:right'>
					<a href='{{route('permissions.addRoute')}}' class='btn btn-sm btn-success '  >Add Route</a>
					<a href='{{route('permissions.syncRoutes')}}' class='btn btn-sm btn-primary '  >Sync Routes</a>
				</span>

			</div>
			<div class='card-body'>
				<table id="tableGroups" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th data-priority="1"> Application Name </th>
							<th data-priority="2"> Url </th>
							<th> Description </th>
							<th data-priority="3"> Action </th></tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
						<tr>
							<td> <a href= "{{route('permissions.view', ['id'=>$permission->id]) }}"  > {{$permission->applicationName or 'Not Defined'}} </a> </td>
							<td>{{$permission->url}}</td>
							<td>{{$permission->description}}</td>
							<td align="center">

								<div class="btn-group" style="min-width: 69px;">
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="{{route('permissions.edit', $permission->id)}}"><i class="fa fa-pencil"></i> Edit</a>
											<a class="dropdown-item" href="{{route('permissions.delete', $permission->id)}}"><i class="fa fa-trash"></i> Delete</a>
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

		$('#tableGroups').DataTable({
			'pageLength':50,
			'responsive':true,
			'searching':false,
			'lengthChange':false
			
		});
		
	});
	
</script>
@endsection
