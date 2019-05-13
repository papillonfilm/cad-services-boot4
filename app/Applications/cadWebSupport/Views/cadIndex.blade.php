@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">

        <div class="card">
            <div class="card-header">
                <h3 class='card-title'>Choose Action</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('findAccount')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Delete Account</a>
                        </div>
                    </div>
                    <!-- /.col-->
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('findAccountRP')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Change Password</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('templateIndex')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Email Templates</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('cadEmailIndex')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Cad-Web Emails</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('docIndex')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Documentation</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2 col-lg-2">
                            <a href="{{route('getEmails')}}" class="btn btn-primary btn-lg" role="button" style="width:160px;height:80px;">Get Emails</a>
                        </div>
                    </div>
                    <!-- /.col-->
                </div>

            </div>
        </div>
    </div>





@endsection


