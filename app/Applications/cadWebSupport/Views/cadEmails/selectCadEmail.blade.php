<?php
/**
 * Created by PhpStorm.
 * User: KBlanck
 * Date: 4/2/2019
 * Time: 4:05 PM
 */
?>
@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')


    <div class="animated fadeIn">
        <div class='card card-solid '>
            <div class='card-header with-border'>
                <h3 class='card-title'>Cad Email</h3>
            </div>


                <div class='card-body'>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-3">
                                    <form id="listForm" class="form-horizontal" method="POST" action="{{route('processCadEmailTemplate')}}">
                                        <input type="hidden" name="cadFrom" id="cadFrom" value="{{ $cadEmail->from }}">
                                        <input type="hidden" name="cadName" id="cadName" value="{{ $cadEmail->name }}">
                                        <input type="hidden" name="cadCc" id="cadCc" value="{{ $cadEmail->cc }}">
                                        <input type="hidden" name="cadSubject" id="cadSubject" value="{{ $cadEmail->subject }}">
                                        <input type="hidden" name="cadBodyText" id="cadBodyText" value="{{ $cadEmail->bodyText }}">

                                        {!! csrf_field() !!}
                                        <input type="submit" class="btn btn-primary" value="Select Email Template">
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form id="listForm" class="form-horizontal" method="POST" action="{{route('processCadEmailDelete')}}">
                                        <input type="hidden" name="cadFrom" id="cadFrom" value="{{ $cadEmail->from }}">
                                        <input type="hidden" name="cadName" id="cadName" value="{{ $cadEmail->name }}">
                                        <input type="hidden" name="cadCc" id="cadCc" value="{{ $cadEmail->cc }}">
                                        <input type="hidden" name="cadSubject" id="cadSubject" value="{{ $cadEmail->subject }}">
                                        <input type="hidden" name="cadBodyText" id="cadBodyText" value="{{ $cadEmail->bodyText }}">

                                        {!! csrf_field() !!}
                                        <input type="submit" class="btn btn-primary" value="Delete Account">
                                    </form>
                                </div>
                                <div class="col-sm-3">
                                    <form id="listForm" class="form-horizontal" method="POST" action="{{route('processCadEmailRP')}}">
                                        <input type="hidden" name="cadFrom" id="cadFrom" value="{{ $cadEmail->from }}">
                                        <input type="hidden" name="cadName" id="cadName" value="{{ $cadEmail->name }}">
                                        <input type="hidden" name="cadCc" id="cadCc" value="{{ $cadEmail->cc }}">
                                        <input type="hidden" name="cadSubject" id="cadSubject" value="{{ $cadEmail->subject }}">
                                        <input type="hidden" name="cadBodyText" id="cadBodyText" value="{{ $cadEmail->bodyText }}">

                                        {!! csrf_field() !!}
                                        <input type="submit" class="btn btn-primary" value="Reset Password">
                                    </form>
                                </div>
                            </div>

                            <br />
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 form-group">
                                        <label for="respondToEmail" class="control-label">From:</label>
                                        <input type="email" class="form-control" name="from" id="from" value="{{ $cadEmail->from }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 form-group">
                                        <label for="respondToName" class="control-label">Name:</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $cadEmail->name }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 form-group">
                                        <label for="subject" class="control-label">CC:</label>
                                        <input type="text" class="form-control" name="cc" id="cc" value="{{ $cadEmail->cc }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-12 form-group">
                                        <label for="subject" class="control-label">Subject:</label>
                                        <input type="text" class="form-control" name="subject" id="subject" value="{{ $cadEmail->subject }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12 form-group">
                                        <label for="status" class="control-label">To</label>
                                        <input type="text" class="form-control" name="to" id="to" value="{{ $cadEmail->to }}" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-12 form-group">
                                        <label for="comments" class="control-label">Original Message</label>
                                        <div style="border:1px solid black;padding: 10pt;">
                                            {!! $cadEmail->bodyText !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(count($attachments) > 0)
                                @foreach ($attachments as $attachment)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12 form-group">
                                                <label for="comments" class="control-label">Attachments</label>
                                                <div style="border:1px solid black;padding: 10pt;">
                                                    <a href="{{ $attachment['dir'] }}" target="_blank">{{ $attachment['filename'] }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif

                                <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-lg-12" align="center">
                                            <a href="{{route('cadEmailIndex')}}" class="btn btn-primary">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

        </div>
    </div>



@endsection
