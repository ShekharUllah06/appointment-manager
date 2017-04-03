@extends('layouts.admin')
@section('title', 'Admin Settings')
@section('description', 'This is the Admin Chamber page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            @yield('chamberHead')
        </div>
    </div>
    
<div class="row col-lg-12">   
        @yield('chamberBody')
</div>
    
    @yield('jscript')
    
@endsection