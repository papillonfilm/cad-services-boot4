@extends('layouts.template')
@section('pageTitle', 'Edit Category')
@section('content')

<div class="animated fadeIn">
	<form role='form' name='form1' method='post' action='{{route('categories.updateRecord')}}' >
		<div class='row'>
			<div class='col-md-12'>
				<div class='card card-solid'>
					<div class='card-header'>
						<h3>Edit Category</h3>
					</div>
					<div class='card-body'>
						<div class='form-group'>
							<label for='name' > Name </label>
							<input type='text' class='form-control' name='name' id='name' placeholder='Name' value='{{$sysApplicationCategories->name}}' >
						</div>
						<div class='form-group'>
							<label for='description' > Description </label>
							<input type='text' class='form-control' name='description' id='description' placeholder='Description' value='{{$sysApplicationCategories->description}}' >
						</div>
						<div class='form-group'>
							{!! csrf_field() !!}
							 <input type='hidden' name='id' value='{{$sysApplicationCategories->id }}'>
							<input type='submit' value='Save Changes' class='btn btn-primary'>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
