@extends('patient.search')
@section('title', 'Doctor Search Form')
@section('description', 'This is the Doctor Search form')


@section('searchBody')     
        
    <!--Starting the Form-->

    <form action="{!! url('patient/search') !!}" method="post" class="well form-horizontal" id="scheduleForm"  style="margin-bottom: 10px; padding-bottom: 4px;">
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
                            @foreach($JSONSpecialties as $JSONSpecialty)                           
                                <option value="{!! $JSONSpecialty['specialty'] !!}">{{ $JSONSpecialty['specialty'] }}</option>  
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
                            @foreach($districtsList as $districtName)                           
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
    
    <div>
    <!--Result Section-->
        <?php 
            $i = 0; 
            foreach ($doctors as $doctor){
             
                if($i % 2 == 0){
                    print '<div class="row oddCard" id="doctorSearchCard">';
                }else{
                    print '<div class="row" id="doctorSearchCard">';
                }
        ?>
                <!--Info section start-->
                <div class="col-md-7" style="margin: 10px;">
                    <div class="row">
                        <!--Profile Image-->
                        <div class="col-md-3">
                            <img src="{{ url('uploads/avatars/'.$doctor['imageUrl']) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 20%;"/>
                        </div>
                        <!--Short Description-->
                        <div class="col-md-7" style="text-align: left">
                            <div class="row">
                                <h4><b><?php if($doctor['first_name']){ echo(ucfirst($doctor['first_name']));} ?> <?php if($doctor['last_name']){echo(ucwords($doctor['last_name'])); } ?></b></h4>
                            </div>
                            <div class="row">                           
                                <span style="border: 5px; padding: 5px;">
                                    <?php if(isset($doctor['position'])){
                                                    print($doctor['position']);
                                                    print(", <b>At: </b>");
                                                    print($doctor['organization']);                                     
                                            }else{ 
                                                    print("Unknown");
                                                    print(", <b>At: </b>");
                                                    print("Unknown");  
                                            }
                                    ?>
                                </span>
                            </div>
                            <div class="row">
                                @if(count($doctor['degree_name']) < 1)
                                    Education Information not yet submitted.
                                @else
                                    <span style="border: 5px; padding: 5px;">
                                        <b>Degree:</b> {{ $doctor['degree_name'][0] }}
                                    </span>  
                                    @if(count($doctor['degree_name']) > 1)
                                        <div class="collapse" id="deg{{ $i }}" style="margin-right: 10px;">
                                            <?php $j = 1;
                                                  for($j; $j<count($doctor['degree_name']); $j++){
                                            ?>
                                                <span style="border: 5px; padding: 5px;">
                                                    {{ $doctor['degree_name'][$j] }}<br />
                                                </span>
                                            <?php } ?>
                                        </div>
                                        <button id="seeDeg{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#deg{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                            See more
                                        </button>
                                    @endif
                                @endif                                
                            </div>
                            <div class="row">
                                @if(count($doctor['specialty']) < 1)
                                    Specialties Information not yet submitted.
                                @else
                                    <span style="border: 5px; padding: 5px;">
                                        <b>Specialties: </b> {{ $doctor['specialty'][0] }}
                                    </span>
                                    @if(count($doctor['specialty']) > 1)
                                        <div class="collapse" id="sec{{ $i }}" style="margin-right: 10px;">
                                            <?php $k = 0;
                                                  for($k; $k<count($doctor['specialty']); $k++){
                                            ?>
                                                <span style="border: 5px; padding: 5px;">
                                                    {{ $doctor['specialty'][$k] }}<br />
                                                </span>
                                            <?php } ?>
                                        </div>
                                        <button id="seeSpc{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                            See more
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

                <!--Calander Section start-->
                <div class="col-md-4" style="float: right; margin: 3px;">
                    <table class="table table-bordered" style="font-size: 10px; background-color: white;">
                        <thead>  

                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th style="color: red">Fri</th>  
                                <th>Sat</th>
                        </thead> 



                    </table>   
                </div>
    </div> 
    <?php
            $i++;
               }
   ?>
    
    <!--Pagination Navigation Section-->
    <div class="row">
        <?php 
            if((isset($array_data['total_page'])) && ($array_data['total_page'] > 1)){
                $count = 0;
                print('<div class="col-md-4"></div>'
                        . '<div class="col-md-4">'
                        . '<nav aria-label="Page navigation">'
                        . '<ul class="pagination">');
                
                if($array_data['current_page'] > 0){
                    print('<li class="page-item">'
                            . '<a href="#" class="page-link" aria-label="Previous" onclick="ajaxGetPage()"> '
                            . '<span aria-hidden="true"> &raquo; </span>'
                            . '<span class="sr-only"> Previous </span>'
                            . '</a>'
                            . '</li>');
                }

                for($count; $count < $array_data['total_page']; $count++){
                    $count2 = $count + 1;
                    print('<li class="page-item">'
                            . '<a href="#" class="page-link" onclick="ajaxGetPage('.$count.')">'.$count2.'</a>'
                            . '</li>');
                }
                
                if(count($array_data['total_page'])-($array_data['current_page']) >= 1){
                    print('<li>'
                            . '<a href="#" class="page-link" aria-label="Next" onclick="ajaxGetPage()"> '
                            . '<span aria-hidden="true"> &raquo; </span>'
                            . '<span class="sr-only"> Next </span>'
                            . '</a>'
                            . '</li>');
                }

                print('</ul>'
                        . '</nav>'
                        . '</div>'
                        . '<div class="col-md-4"></div>');
            }
        ?>
    </div>
            
                
       <?php print'<pre>'; print_r($temp); print"</pre>"; ?> <hr />
         
@endsection
 
 

@section('jscriptPatientSearch')    
    <script>    
//Retrive thana by district through ajax
        $(document).ready(function(){
            $("#district").change(function(dData){
                var districtVal = $("#district").val();
                var myUrl = "/patient/search/ajax/";

                $.ajax({
                    url : myUrl + districtVal,
                    type : "GET",
                    contentType:"application/json",
                    dataType : 'json',
                    success: function(data){
                        
                            if(data.length){
                                $("#thana").html('');
                                        $.each(data, function(key, value){
                                            var listItem = new Option(value.thana, value.thana);                                     
                                            $("#thana").append(listItem);
                                        });
                            }else{
                                $("#thana").html('<option value="" selected disabled>No List Found</option>');
                            }
                        },
                    error: function(data){
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));

                    }
                });       
            });
        });   
        

//        Get paginated search result
        function ajaxGetPage(terget_page){
            
            
            };
        
        
        
//        Change See More Buten Text
        function changeBtnTxt(){
            
            var target= event.target || event.srcElement;
            var id = target.id;
            var txtElem = document.getElementById(id);               
            var text = txtElem.textContent || txtElem.innerText;
            
            if (text.includes("See more")) {
                
                txtElem.textContent = "See less";

            }else{
                
                txtElem.textContent = "See more";

            }
        }       
         
    </script>
@endsection
