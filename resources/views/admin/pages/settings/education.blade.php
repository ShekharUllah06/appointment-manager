@extends('layouts.admin')
@section('title', 'Admin Education')
@section('description', 'This is the Admin Education page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Education
                </li>
            </ol>
                @include('notifications.status_message')
                @include('notifications.errors_message')
        </div>
    </div>
</div>

@endsection