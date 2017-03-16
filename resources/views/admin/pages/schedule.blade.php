@extends('layouts.admin')
@section('title', 'Admin Schedule')
@section('description', 'This is the Admin Schedule page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                @if (Auth::guest())
                Admin <small>Schedule page</small>
                @else
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}'s <small>Admin Schedule page</small>
                @endif

            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Work History
                </li>
            </ol>
                @include('notifications.status_message')
                @include('notifications.errors_message')
        </div>
    </div>
</div>

@endsection