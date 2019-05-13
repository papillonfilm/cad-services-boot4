@extends('layouts.template')
@section('pageTitle', 'Categories')
@section('content')

<div class="animated fadeIn">
	<div class='row'>
		<div class='col-md-12'>
			<div class='card card-solid'>
				<div class='card-header'>
					<h3 style='display:inline-block'>Manage Categories</h3>
					<a href='{{route('categories.addRecord')}}' class='btn btn-success' style='float:right;'><i class='fa fa-plus'></i> Add Category</a>
				</div>
				<div class='card-body'>
					<table class='table table-bordered table-hover responsive nowrap' width='100%' id='table' >
						<thead>
							<tr>
								<th> Name </th>
								<th> Description </th>
								<th> Action </th>
							</tr>
						</thead>
						<tbody>
							@foreach ($sysApplicationCategories as $row)
								<tr>
									<td> {{$row->name}} </td>
									<td> {{$row->description}} </td>
									<td>

										<div class="btn-group" style="min-width: 69px;">
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle btn-xs" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="{{route('categories.editRecord',['id'=> $row->id])}}"><i class="fa fa-pencil"></i> Edit</a>
													<a class="dropdown-item" href="{{route('categories.deleteRecord',['id'=> $row->id])}}"><i class="fa fa-trash"></i> Delete</a>
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
	</div>
</div>
@endsection
@section('javascript')

<script type="text/javascript">
	$(document).ready(function(){
		$('#table').DataTable({ 
			'pageLength':50,
			'searching':false,
			'responsive':true,
			'lengthChange':false
		});
	});
</script>
@endsection
