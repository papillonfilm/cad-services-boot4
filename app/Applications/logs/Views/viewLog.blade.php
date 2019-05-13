@extends( 'layouts.template' )
@section('pageTitle', 'View Log')
@section( 'content' )
 <div class='row'>
	<div class='col-md-12'>
		<div class='box  box-solid'>
			<div class='  box-body'>
				<ul class='nav flex-column'>
					<li class='list-group-item'> Date: <span class='pull-right'> {{$log->created_at}}</span>
					</li>
					<li class='list-group-item'> Type:<span class='pull-right'>{{$log->type}}</span>
					</li>
					<li class='list-group-item'> Category:<span class='pull-right'> {{$log->category}}</span>
					</li>
					<li class='list-group-item'> User: <span class='pull-right'>
						{{$user->name or ''}} {{$user->initial or ''}} {{$user->lastname or ''}} {{$user->lastname2 or ''}} 
						</span>
					</li>
					<li class='list-group-item'> Page:<span class='pull-right'> {{$log->url}}</span>
					</li>
					<li class='list-group-item'> IP Address:<span class='pull-right'> {{$log->ip}} </span>
					</li>
					<li class='list-group-item'> UserAgent<span class='pull-right'> {{$log->userAgent}} </span>
					</li>
					<li class='list-group-item'> Description:<span class='pull-right'> {{$log->description}}</span>
					</li>
				</ul>
			</div>
		</div>
	 </div>
</div>
	 
@endsection

@section( 'javascript' )

@endsection

@section( 'css' )

@endsection