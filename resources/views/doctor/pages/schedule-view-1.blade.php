@extends('doctor.pages.schedule')
@section('title', 'Schedule List View')
@section('description', 'This is the Schedule page')

@section('scheduleHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Schedule List View</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message')

@endsection

@section('scheduleBody')
<?php print'<pre>'; print_r($schedules); print"</pre>"; ?>
@endsection
