@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')


    <div class='box box-solid '>
        <div class='box-header with-border'>
            <h3 class='box-title'>Create Email Template</h3>
        </div>
        <div class='box-body'>
            <form id="listForm" class="form-horizontal" method="POST" action="{{route('insertEmailTemplate')}}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label for="status">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ old('title') }}"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label for="comments">Email Template</label>
                            <textarea class="form-control" name="emailTemplate" id="emailTemplate" rows="20">{{ old('emailTemplate') }}</textarea>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
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



@endsection