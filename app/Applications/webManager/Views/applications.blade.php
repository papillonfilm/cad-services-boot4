@extends('layouts.template')
@section('pageTitle', 'Applications')
@section('content')

	<div class="animated fadeIn">
		<div class='card card-solid '>
			<div class='card-header with-border'>
				<h3 class='card-title'>  Applications </h3>
				<a href='{{route('addApplication')}}' class='btn btn-sm btn-success '  style='float:right'>Add Application</a>
			</div>
			<div class='card-body'>
				<table id="tableApps" class="table table-bordered table-hover responsive nowrap" width="100%">
					<thead>
						<tr>
							<th width='20%' data-priority="1"> Name </th>
							<th> Description </th>
							<th   data-priority="2"> Action </th></tr>
					</thead>
					<tbody>
						@foreach ($applications as $app)
						<tr>
							<td>
								<a href="{{route('viewApplication',['id'=>$app->id])}}" >
									<img src="{{asset($app->iconPath)}}"  alt="Icon" width="25px"> &nbsp; {{$app->name}}
								</a>
							</td>
							<td>{{$app->description}}</td>
							<td align="center">
								<div class="btn-group" style="min-width: 69px;">
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="{{route('editApplication', $app->id)}}"><i class="fa fa-pencil"></i> Edit</a>
											<a class="dropdown-item" href="{{route('deleteApplication', $app->id)}}"><i class="fa fa-trash"></i> Delete</a>
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

		$('#tableApps').DataTable({
			'pageLength':50,
			'responsive':true,
			 
		});
		
	});
	
</script>
@endsection