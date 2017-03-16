@extends('layouts.admin')
@section('title', 'Admin Personal Information')
@section('description', 'This is the Admin Personal Information page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if (Auth::guest())
                Admin <small>Personal Information Page</small>
                @else
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}'s <small>Admin Personal Information Page</small>
                @endif

            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Personal Information
                </li>
            </ol>
                @include('notifications.status_message')
                @include('notifications.errors_message')
        </div>
    </div>
</div>

@endsection