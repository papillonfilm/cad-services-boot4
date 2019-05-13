<?php
/**
 * Created by PhpStorm.
 * User: KBlanck
 * Date: 4/1/2019
 * Time: 9:48 AM
 */
?>
@extends('layouts.template')
@section('pageTitle', 'Cad Web Support')
@section('content')

    <div class="animated fadeIn">
        <div class='card'>
            <div class='card-header with-border'>
                <h3 class='card-title'>Email Template</h3>
            </div>
            <div class='card-body'>
                <form id="listForm" class="form-horizontal" method="POST" action="{{route('sendEmailTemplate')}}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-6 form-group">
                                <label for="respondToEmail" class="control-label">Respond To Email:</label>
                                <input type="email" class="form-control" name="respondToEmail" id="respondToEmail" value="{{ old('respondToEmail', $cadFrom) }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-6 form-group">
                                <label for="respondToName" class="control-label">Respond To Name:</label>
                                <input type="text" class="form-control" name="respondToName" id="respondToName" value="{{ old('respondToName', $cadName) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-md-6 form-group">
                                <label for="subject" class="control-label">Subject:</label>
                                <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject', $cadSubject) }}">
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
                    <input type="hidden" name="cadBodyText" id="cadBodyText" value="{{ $cadBodyText }}">
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