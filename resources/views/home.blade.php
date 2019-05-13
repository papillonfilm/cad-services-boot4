@extends('layouts.template')

@section('pageTitle', 'Dashboard')
@section('content')
 
<div>

<!-- Container -->	
	@if(isset($categories))
		@foreach($categories as $category)
			<div class="card">
				<div class="card-header">
					  {{$category->name}}
				</div>
				<div class="card-body">
					<div class="row">
							@if(isset($applications))
								@foreach($applications as $apps)
									 @if($category->id == $apps->categoryId)

									<div>
											@if(Route::getRoutes()->hasNamedRoute($apps->location))
												<a href='{{route($apps->location)}}' >
											@else
												<a href='#noRoute' >
											@endif
												<div class='appBox' >
													<img src='{{asset($apps->iconPath)}}'  width='64px' height='64px'><br>{{$apps->name}}
												</div>
											</a>
									</div>
									@endif
								@endforeach
							@endif

					</div>
				</div>
			</div>
		@endforeach
	 @endif
<!-- end Container -->
 
</div>
  
@endsection

