@extends('layouts.admin')
@section('title', 'Camber Section')
@section('description', 'This is the Chamber page')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto">
            @yield('chamberHead')
        </div>
    </div>
</div>
<div class="container-fluid">  
    <div class="row">
        <div class="col-lg-12">
            @yield('chamberBody')
        </div>
    </div>
</div>
    @yield('jscript')
    
@endsection