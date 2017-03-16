@extends('layouts.admin')

@section('title', 'Dashboard')
@section('description', 'This is the dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @if (Auth::guest())
                    Admin <small>Dashboard</small>
                    @else
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}'s <small>Dashboard</small>
                    @endif

                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
                    @include('notifications.status_message')
                    @include('notifications.errors_message')
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <p>You are now in the administrator section. This is the dashboard and nothing but only the Menu works but you are logged-in as an admin <i class="fa fa-smile-o fa"></i>. Once you are done looking around, you can <a href="{{ url('/logout') }}"
                                                        onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                                        <i class="fa fa-fw fa-power-off"></i> Log Out
                                                </a> by clicking  <a href="{{ url('/logout') }}"
                                                        onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">here</a> or by hovering over your name and selecting logout on the dropdown menu on the top-right corner.</p>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->
@endsection