@extends('layouts.template')
@section('pageTitle', 'Edit Message')
@section('content')

<div class="animated fadeIn">
	<div class='card card-solid '>
		<div class='card-header with-border'>
			<h3 class='card-title'> Edit Message </h3>

		</div>
		<div class='card-body'>


			<form method="post" action="{{route('updateMessage')}}">

				<div class='form-group'>
				  <label for='author'>Message Name</label>
				  <input class='form-control' name='name' placeholder='Name' type='text' value="{{$message->name}}">
				</div>

				<div class='form-group'>
					<label> Target  </label>
					<select class='form-control' name='target' id='target'>
						<option value="0" {{ $target=="0"?"selected='selected'":'' }} >--Select Target--</option>
						<option value="1" {{ $target=="1"?"selected='selected'":'' }}>User</option>
						<option value="2" {{ $target=="2"?"selected='selected'":'' }}>Group</option>
						<option value="3" {{ $target=="3"?"selected='selected'":'' }}>Application</option>
					</select>
				</div>



				<div class='form-group' id='targetUser'>
					<label> Target User </label>
					<select class='form-control' name='userId' id='userId'>
						<option value="">--Select User--</option>
						@if(isset($users))
							@foreach($users as $user)
								<option value='{{$user->id}}' {{ $user->id==$message->userId?"selected='selected'":'' }} >{{$user->name}} {{$user->initial or ''}} {{$user->lastname or ''}} {{$user->lastname2 or ''}} </option>
							@endforeach
						@endif
					</select>
				</div>

				<div class='form-group' id='targetGroup'>
					<label> Target Group </label>
					<select class='form-control' name='groupId'>
						<option value="">--Select Group--</option>
						@if(isset($groups))
							@foreach($groups as $group)
								<option value='{{$group->id}}'  {{ $group->id==$message->groupId?"selected='selected'":'' }}>{{$group->name}}   </option>
							@endforeach
						@endif
					</select>
				</div>

				<div class='form-group' id='targetApplication'>
					<label> Target Application </label>
					<select class='form-control' name='applicationId'>
						<option value="">--Select Application--</option>
						@if(isset($applications))
							@foreach($applications as $application)
								<option value='{{$application->id}}' {{ $application->id==$message->applicationId?"selected='selected'":'' }} >{{$application->name}}   </option>
							@endforeach
						@endif
					</select>
				</div>


				<div class='form-group'>
				  <label for='author'>Start Date</label>
				  <input class='form-control' name='startDate' id='startDate' placeholder='Start Date' type='text' value="{{date("m/d/Y", strtotime($message->startDate))}}" >
				</div>

				<div class='form-group' style="width: 40%; display: inline-block">
				  <label for='author'>End Date</label>
				  <input class='form-control' name='endDate' id='endDate' placeholder='End Date' type='text' value="{{ date("m/d/Y", strtotime($message->endDate)) }}" >
				</div>

				<span style="width: 18%; display: inline-block; text-align: center"> OR</span>

				<div class='form-group' style="width: 40%; display: inline-block; float: right">
					<label> Show Times </label>
					<select class='form-control' name='showTimes'>
						<option value="999999" {{ $message->showTimes=="999999"?"selected='selected'":'' }}>--Select Times--</option>
						<option value='1'  {{ $message->showTimes=="1"?"selected='selected'":'' }} > 1 </option>
						<option value='2'  {{ $message->showTimes=="2"?"selected='selected'":'' }} > 2 </option>
						<option value='3'  {{ $message->showTimes=="3"?"selected='selected'":'' }} > 3 </option>
						<option value='4'  {{ $message->showTimes=="4"?"selected='selected'":'' }} > 4 </option>
						<option value='5'  {{ $message->showTimes=="5"?"selected='selected'":'' }} > 5 </option>
						<option value='10' {{ $message->showTimes=="10"?"selected='selected'":'' }}> 10 </option>
						<option value='15' {{ $message->showTimes=="15"?"selected='selected'":'' }}> 15 </option>
						<option value='20' {{ $message->showTimes=="20"?"selected='selected'":'' }}> 20 </option>
						<option value='25' {{ $message->showTimes=="25"?"selected='selected'":'' }}> 25 </option>
					</select>
				</div>

				<div class='form-group' style=" ">
					<span>*[End Date] or [Show Times] wich ever comes first.  </span>

				</div>

				<div class='form-group'>
					<label for='name' class=''>Message</label>
					<textarea class='form-control' name='message' rows='3' placeholder='Enter message...'>{{$message->message}}</textarea>

				</div>


				{!! csrf_field() !!}
				<input type="hidden" value="{{$message->id}}" name='id' >
				<input type="submit" value="Update Message" class="btn btn-primary" >

			</form>
		</div>
	</div>
</div>

 
@endsection
@section('css')
<link rel='stylesheet' href="{{ asset('css/bootstrap-datepicker3.css') }}">
@endsection

@section('javascript')
<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
		
		
		$("#targetUser").hide();
		$("#targetGroup").hide();
		$("#targetApplication").hide();
		
		$("#startDate").datepicker({
			autoclose:true
		});
		$("#endDate").datepicker({
			autoclose:true
		});
		
		
		$("#target").change(function(){
			
			displayTarget();

		});
		
		
		function displayTarget(){
			if( $("#target").val() == 1  ){
			   // User
				$("#targetUser").slideDown();
				$("#targetGroup").slideUp();
				$("#targetApplication").slideUp();
			}else if( $("#target").val() == 2 ){
				// Group
				$("#targetUser").slideUp();
				$("#targetGroup").slideDown();
				$("#targetApplication").slideUp();
			}else if($("#target").val() == 3  ){
				// Application
				$("#targetUser").slideUp();
				$("#targetGroup").slideUp();
				$("#targetApplication").slideDown();
			}else{
				$("#targetUser").slideUp();
				$("#targetGroup").slideUp();
				$("#targetApplication").slideUp();
			}
		}
		
		// set defaults
		displayTarget();
		
	});
	
	
	
	
</script>

@endsection
 