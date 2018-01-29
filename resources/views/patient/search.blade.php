@extends('layouts.patient')
@section('title', 'Search Section')
@section('description', 'This is the Doctor Search layout')

@section('content')

<!--Starting the Form-->
<!--filter section of the page--> 
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-auto"> 
            <form action="{!! url('patient/search/result') !!}" method="post" class="well form-horizontal" id="scheduleForm"  style="margin-bottom: 10px; padding-bottom: 4px;">
                <h4 style="margin-top: -6px; margin-bottom: -6px;">Filter By:</h4>
                <hr style="margin-top: 12px; margin-bottom: 12px;" />
                <fieldset>
                    <div class="row">

                        <!--Specialty-->                
                        <div class="form-group col-md-5">
                            <label for="specialty" class="col-md-4 control-label">Specialty: </label>
                            <div class="col-md-8">
                                <select id="specialty" name="specialty" class="form-control col-md-8" >
                                    <option value="" selected disabled>By Specialty..</option>
                                    @foreach($filterItems['specialty'] as $specialtyName)                           
                                        <option value="{!! $specialtyName['specialty'] !!}">{{ $specialtyName['specialty'] }}</option>  
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <script>document.getElementById('specialty').value = '{{ $selectedItems["specialty"] }}';</script>

                        <!--District-->
                        <div class="form-group col-md-5">
                            <label for="district" class="col-md-4 control-label">District: </label>
                            <div class="col-md-8">
                                <select id="district" name="district" class="form-control">
                                    <option value="" selected disabled>By District..</option>
                                    @foreach($filterItems['district'] as $districtName)                           
                                        <option value="{!! $districtName['district'] !!}">{{ $districtName['district'] }}</option>  
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <script>document.getElementById('district').value = '{{ $selectedItems["district"] }}';</script>

                        <div class="form-group" id="BTN_clear"> 
                            <div class="col-md-2 float-right" >
                                <a href="{{url('patient/search')}}"><button type="button" class="btn btn-md btn-warning"><span class="glyphicon glyphicon-remove"></span> Clear</button></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">                              
                        <!--Area-->
                        <div class="form-group col-md-5">
                            <label for="area" class="col-md-4 control-label">Area: </label>
                            <div class="col-md-8">
                                <select id="area" name="area" class="form-control">
                                    <option value="" selected disabled>By Area..</option>
                                        <?php
                                            print ('<option>ad</option>');
                                        ?>
                                </select>
                            </div>
                        </div>
                        <script>document.getElementById('area').value = '{{ $selectedItems["area"] }}';</script>

                        <!--Thana-->
                        <div class="form-group col-md-5">
                            <label for="thana" class="col-md-4 control-label">Thana: </label>
                            <div class="col-md-8">
                                <select id="thana" name="thana" class="form-control">
                                    <option value="" selected disabled>By Thana..</option>
                                        <!--Ajax Call for Thana Lis-->
                                </select> 
                            </div>
                        </div>
                        <script>document.getElementById('thana').value = '{{ $selectedItems["thana"] }}';</script>
                    <!--Submit, Delete and Cancel Button-->
                        <div class="form-group" id="BTN_filter">                                
                            <div class="col-md-2 float-right" >
                                <button type="submit" class="btn btn-md btn-info"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                            </div>                               
                        </div>
                    </div>

                </fieldset>

                {{ csrf_field() }}

            </form>
    
        </div>
    </div>
</div>

<!--Result section of the page-->  
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