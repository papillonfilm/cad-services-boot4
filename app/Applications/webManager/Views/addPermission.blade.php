@extends('layouts.template')
@section('pageTitle', 'Edit Route')
@section('content')


<div class="animated fadeIn">
	<form role='form' id ='form1' name='form1' action="{{route('permission.route.save')}}" method="post">
		<div class='row' >
			 <div class='col-md-12'>
			<!-- Horizontal Form -->
				<div class='card card-solid'>
					<div class='card-header with-border'>
						<h3 class='card-title'>Route Information</h3>
					</div>


					<div class=' card-body'>
							<div class='form-group'>
							<label for='name' class=''>Applicatin Name</label>
							<input type='text' class='form-control' name='applicationName' placeholder='Application Name' value='{{old('applicationName')}}'>

						</div>

						<div class='form-group'>
							<label for='name' class=''>Url</label>
							<input type='text' class='form-control' name='url' placeholder='url' value='{{old('url')}}'>

						</div>

						<div class='form-group'>
							<label for='name' class=''>Description</label>

							<textarea class='form-control' name='description' rows='3' placeholder='Enter description...'>{{old('description')}}</textarea>
						</div>
						<div class='form-group'>
							 @csrf()

							<input type='submit' class='btn btn-success'  value='Save Changes' name='button'>

						</div>

				 </div>
			</div>
		</div>
	</form>
</div>
	 
 
		

	 
 
@endsection
