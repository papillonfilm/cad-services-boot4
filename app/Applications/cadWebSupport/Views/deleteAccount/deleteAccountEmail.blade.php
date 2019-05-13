<?php
/**
 * Created by PhpStorm.
 * User: KBlanck
 * Date: 4/3/2019
 * Time: 11:21 AM
 */
?>

@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">
        <div class='card'>
            <div class='card-header with-border'>
                <h3 class='card-title'>Delete Email Template</h3>
            </div>
            <div class='card-body'>
                <form id="listForm" class="form-horizontal" method="POST" action="{{route('deleteAccount')}}">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class ="col-sm-3">
                                    <label for="respondToEmail" class="control-label">Respond To Email:</label>
                                    <input type="email" class="form-control" name="respondToEmail" id="respondToEmail" value="{{ old('respondToEmail', $cadFrom) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class ="col-sm-3">
                                    <label for="respondToName" class="control-label">Respond To Name:</label>
                                    <input type="text" class="form-control" name="respondToName" id="respondToName" value="{{ old('respondToName', $cadName) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class ="col-sm-3">
                                    <label for="subject" class="control-label">Subject:</label>
                                    <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject', $cadSubject) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label for="status" class="control-label">Title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ $cadEmailTemplate->title }}" readonly/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label for="comments" class="control-label">Email Template</label>
                                <textarea class="form-control" name="emailTemplate" id="emailTemplate" rows="20">{{ old('emailTemplate', $cadEmailTemplate->emailTemplate) }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label for="comments" class="control-label">Original Message</label>
                                <div style="border:1px solid black;padding: 10pt;">
                                    {!! $cadBodyText !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! csrf_field() !!}
                    <input type="hidden" name="userId" id="userId" value="{{ $userId }}">
                    <input type="hidden" name="loginId" id="loginId" value="{{ $loginId }}">
                    <input type="hidden" name="cadBodyText" id="cadBodyText" value="{{ $cadBodyText }}">
                    <!--input type="submit" id="submitBtn" class="btn btn-success" value="Submit">-->
                    <input type="button" name="btn" value="Submit" id="submitBtn" data-toggle="modal" data-target="#confirm-delete" class="btn btn-success"  />


                </form>



                <!--div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-lg-12" align="center">
                                <a href="{{route('cadWebSupport')}}" class="btn btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>

                <div class="modal-body">

                    <div>
                        <p>You are about to delete an account. This procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" id="submit" class="btn btn-danger btn-ok submitBtn">Yes</a>
                        <!--button type="button" class="btn btn-danger btn-ok">Yes</button>-->
                        <!--button class="btn btn-danger btn-ok" id="submit" type="submit">Yes</button>-->
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                    </div>

                </div><!-- End of Modal body -->

            </div>
        </div>
    </div>



@endsection

@section('javascript')

    <script type="text/javascript">

        $('#submit').on('click' , function() {
            //alert("hey");
            /* when the submit button in the modal is clicked, submit the form */
            //alert('submitting');
            $('#listForm').submit();
        });

//        $('.submitBtn').on('click' , function() {
//            alert("hey");
//
//            //$('#confirm-delete').modal();
//
//        });

    </script>

@endsection
