@extends('patient.search')
@section('title', 'Doctor Search Form')
@section('description', 'This is the Doctor Search form')

@section('searchHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Doctor Search Form
        </li>
    </ol>

    @include('notifications.status_message')
    @include('notifications.errors_message')
        
@endsection


@section('searchBody')     
        
    <!--Starting the Form-->

    <form action="{!! url('patient/search') !!}" method="post" class="well form-horizontal" id="scheduleForm">
        <h3 style="margin-top: -6px; margin-bottom: -6px;">Filter</h3>
        <hr />
        <fieldset>
            <div class="row">
                
                <!--Specialty-->                
                <div class="form-group col-md-4">
                    <label for="specialty" class="col-md-4 control-label">Specialty: </label>
                    <div class="col-md-8">
                        <select id="specialty" name="specialty" class="form-control col-md-8" >
                            <option value="" selected disabled>By Specialty..</option>
                            @foreach($specialties as $specialty)                           
                                <option value="{!! $specialty['specialty'] !!}">{{ $specialty['specialty'] }}</option>  
                            @endforeach
                        </select>
                    </div>
                </div>

                <!--District-->
                <div class="form-group col-md-4">
                    <label for="district" class="col-md-4 control-label">District: </label>
                    <div class="col-md-8">
                        <select id="district" name="district" class="form-control" onchange="loadThana(this.value)">
                            <option value="" selected disabled>By District..</option>
                            @foreach($districts as $district)                           
                                <option value="{!! $district['district'] !!}">{{ $district['district'] }}</option>  
                            @endforeach
                        </select> 
                    </div>
                </div>
                
                <!--Thana-->
                <div class="form-group col-md-4">
                    <label for="thana" class="col-md-4 control-label">Thana: </label>
                    <div class="col-md-8">
                        <select id="thana" name="thana" class="form-control">
                            <option value="" selected disabled>By Thana..</option>
                            

                        </select> 
                    </div>
                </div>
            </div>
            
            <div class="row">
                               
                <div class="form-group col-md-4">
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

                <div class="col-md-6"></div>
                
            <!--Submit, Delete and Cancel Button-->

                <div class="form-group" id="BTN_filter">                                

                    <div class="col-md-2" style="margin: 3px; padding: 3px;">
                        <button type="submit" class="btn btn-md btn-info"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                    </div>                               
                </div>
            </div>

        </fieldset>
        
        {{ csrf_field() }}
        
    </form>
    
    <?php print'<pre>'; print_r($doctors); print"</pre>"; ?>
    
    
    
@endsection
 
 

@section('jscriptPatientSearch')    

    <script>    
        function loadThana(districtName){
            var xmlHttpRequest = new XMLHttpRequest();
            xmlHttpRequest.onreadystatechange = function(){
                                        
                if(xmlHttpRequest.status == 200){
//                    var selectThana = document.getElementById("thana");
//                    var i;
                    var jObj = JSON.parse(xmlHttpRequest.responseText);
//                    for(i = 0; i < jObj.length; i++){
alert(jObj.response);
//                        var option = document.createElement("option");

//                        option.text = thanaName;
//                        selectThana.add(option);

                        
//                    }

                }
                xmlHttpRequest.open("GET", "{{ url('patient/search/a') }}", true);
                xmlHttpRequest.send();
            };
        }
    </script>

@endsection
