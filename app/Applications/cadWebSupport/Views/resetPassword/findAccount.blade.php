@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">
        <div class='card'>
            <div class='card-header with-border'>
                <h3 class='box-title'>Enter User Information</h3>
            </div>
            <div class='card-body'>
                <form id="listForm" class="form-horizontal" method="POST" action="{{route('listAccountRPPost')}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class ="col-sm-3">
                                    <label for="email">Email:</label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Look up Account">

                    {!! csrf_field() !!}

                </form>



            </div>
        </div>
    </div>


@endsection
