@extends('layouts.doctor')
@section('title', 'Schedule Section')
@section('description', 'This is the Schedule page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto">
            @yield('scheduleHead')
        </div>
    </div>
</div>
<div  class="container-fluid">  
    <div class="row">
        <div class="col-lg-12">
            @yield('scheduleBody')
        </div>
    </div>
</div>
    @yield('jscript')
    
@endsection