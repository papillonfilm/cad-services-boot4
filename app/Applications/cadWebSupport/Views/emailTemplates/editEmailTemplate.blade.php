@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">
        <div class='card'>
            <div class='card-header with-border'>
                <h3 class='box-title'>Edit Email Template</h3>
            </div>
            <div class='card-body'>
                <form id="listForm" class="form-horizontal" method="POST" action="{{route('updateEmailTemplate', $cadEmailTemplate->id)}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label for="status">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title', $cadEmailTemplate->title) }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label for="comments">Email Template</label>
                                <textarea class="form-control" name="emailTemplate" id="emailTemplate" rows="20">{{ old('emailTemplate', $cadEmailTemplate->emailTemplate) }}</textarea>
                            </div>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                    <input type="hidden" name='id' value="{{$cadEmailTemplate->id}}">
                    <input type="submit" class="btn btn-success" value="Submit">
                </form>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-lg-12" align="center">
                                <a href="{{route('templateIndex')}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection