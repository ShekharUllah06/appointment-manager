@extends('layouts.admin')
@section('title', 'Work History')
@section('description', 'This is the Work History page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto">
            @yield('workHistoryHead')
        </div>
    </div>
</div>
<div  class="container-fluid">  
    <div class="row">
        <div class="col-lg-12">
            @yield('workHistoryBody')
        </div>
    </div>
</div>
    @yield('jscript')

@endsection