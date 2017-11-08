@extends('layouts.patient')
@section('title', 'Search Section')
@section('description', 'This is the Doctor Search layout')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto">
            @yield('searchHead')
        </div>
    </div>
</div>
<div  class="container-fluid">  
    <div class="row">
        <div class="col-lg-12">
            @yield('searchBody')
        </div>
    </div>
</div>
    
@endsection

@section('jscriptPatient')
    <!--JavaScript Section-->
    @yield('jscriptPatientSearch')
    
@endsection