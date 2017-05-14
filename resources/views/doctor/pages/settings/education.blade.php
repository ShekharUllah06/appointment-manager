@extends('layouts.admin')
@section('title', 'Education Section')
@section('description', 'This is the Education page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @yield('educationHead')
        </div>
    </div>

<div class="container-fluid">  
    <div class="row">
        <div class="col-lg-12">
            @yield('educationBody')
        </div>
    </div>
</div>
    
    @yield('jscript')
    
@endsection