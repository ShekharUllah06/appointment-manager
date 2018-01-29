@extends('patient.search')
@section('title', 'Doctor Search Form')
@section('description', 'This is the Doctor Search form')


@section('searchBody')     
        
    <div>
    <!--Result Section-->
        <?php 
            $i = 0; 
            foreach ($doctors as $doctor){
//             check add number of card and style it
                if($i % 2 == 0){
                    print '<div class="row resultCard">'; //oddCard
                }else{
                    print '<div class="row resultCard">';
                }
        ?>
    
        <!--Info section start-->
        <div class="col-md-7">
            <div class="row">
                <!--Profile Image-->
                <div class="col-md-3">
                    <img src="{{ url('uploads/avatars/'.$doctor['imageUrl']) }}" class="cardImage" alt="Profile Picture">
                </div>
                <!--Short Description-->
                <div class="col-md-7 shortDescription">
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
                                <button id="seeDeg{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#deg{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px;">
                                    See more &#9661;
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
                                <button id="seeSpc{{ $i }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $i }}" aria-expanded="false" aria-controls="{{ $i }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px;">
                                    See more &#9661;
                                </button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!--Calander Section start-->
        <div class="col-md-4" style="float: right; margin: 3px;">
            <div class="panel panel-default">
                <table class="table table-bordered" style="font-size: 10px; background-color: white; text-align: center;">
                    <thead>
                        <th colspan="7" style="background-color: lightblue; color: black; text-align: center; padding: 3px;">Schedule Calender:  {{ $doctor['calender']['monthName'] }} - {{ $doctor['calender']['year']}}</th>
                    </thead>
                    <tr style="background-color: lightgrey; font-weight: bold; text-align: left;">  
                        <td style='padding: 2px;'>Sun</td>
                        <td style='padding: 2px;'>Mon</td>
                        <td style='padding: 2px;'>Tue</td>
                        <td style='padding: 2px;'>Wed</td>
                        <td style='padding: 2px;'>Thu</td>
                        <td style="color: red; padding: 3px;">Fri</td>  
                        <td style='padding: 2px;'>Sat</td>
                    </tr> 

                    @for($i = 0; $i < count($doctor['calender']['calender']); $i++)                   
                    <tr>
                        <?php $countDayInWeek = count($doctor['calender']['calender'][$i]);

                            for($j = 0; $j < $countDayInWeek; $j++){
                        ?>
                            <?php if(isset($doctor['calender']['calender'][$i][$j]['chamberName'])){
                                        print ("<td style='background-color: yellow; padding: 0;'>");
                                  }else{
                                      print("<td  style='padding: 2px;'>");
                                  }
                                ?>                  
                                @if((array_search($doctor['calender']['calender'][$i][$j], $doctor['calender']['calender'][$i]) == 5) || (isset($doctor['calender']['calender'][$i][$j]['date']) && ($doctor['calender']['calender'][$i][$j]['date'] == 5))) 
                                    @if(isset($doctor['calender']['calender'][$i][$j]['date']))
                                        <span style="color: red">
                                            {{ $doctor['calender']['calender'][$i][$j]['date'] }}
                                        </span>  
                                    @else
                                        <span style="color: red">
                                            {{ $doctor['calender']['calender'][$i][$j] }}
                                        </span>
                                    @endif
                                @else

                                    @if(isset($doctor['calender']['calender'][$i][$j]['date']))

                                        {{ $doctor['calender']['calender'][$i][$j]['date'] }}

                                    @else
                                        {{ $doctor['calender']['calender'][$i][$j] }}
                                    @endif
                                @endif

                            </td>
                        <?php } ?>
                    </tr>
                @endfor
                <tr style="background-color: lightcyan;"><td colspan="7" style="padding: 2px;"><span style="color: red;">***</span>Yellow Background = Schedule date.</td></tr>
                </table>  
            </div>
        </div>
    </div> 
    <?php
            $i++;
               }
   ?>
    
    <!--Pagination Navigation Section-->
    <div class="row">
        <?php 
            if((isset($array_info['total_page'])) && ($array_info['total_page'] > 1)){
                $count = 0;
                print('<div class="col-md-3"></div>'
                        . '<div class="col-md-6 text-center">'
                        . '<nav aria-label="Page navigation">'
                        . '<ul class="pagination">');
                
                
                //Original return page number starts at 0, but we are displaying and submitting pagination links starting from 1.
                //Previous Button
                if($array_info['current_page'] > 0){                                                                                                            
                    ?>
                        <li class="page-item">
                            <a href=" {{url('patient/search/result', ['pageNo' => $array_info['current_page']])}} " class="page-link" onclick="passFilter($(this).attr('href'))"  aria-label="Previous">
                                <span aria-hidden="true"> &laquo; </span>
                                <span class="sr-only"> Previous </span>
                            </a>
                        </li>
                    <?php
                    
                }
                
                //Page Numbers
                for($count; $count < $array_info['total_page']; $count++){
                    $count2 = $count + 1;
                    ?>
                        <li class="page-item">
                            <a href="{{ url('patient/search/result', ['pageNo' => $count2]) }}" class="page-link" onclick="passFilter($(this).attr('href'))">{{ $count2 }}</a>
                        </li>
                    <?php
                }

                //Next Button
                if(($array_info['total_page'])-($array_info['current_page']) > 1){
                    ?>
                        <li>
                            <a href="{{ url('patient/search/result', ['pageNo' => $array_info['current_page'] +2]) }}" class="page-link" onclick="passFilter($(this).attr('href'))" aria-label="Next"> 
                                <span aria-hidden="true"> &raquo; </span>
                                <span class="sr-only"> Next </span>
                            </a>
                        </li>
                    <?php
                }

                print('</ul>'
                        . '</nav>'
                        . '</div>'
                        . '<div class="col-md-3"></div>');
            }
        ?>
    </div>

         
@endsection
 
 

@section('jscriptPatientSearch')    
    <script>    

//Check if server returned thana name (from query result page change), else Retrive thana by district through ajax
    if('{{$selectedItems["thana"]}}'){
        $("#thana").append("<option value={{$selectedItems["thana"]}} selected='selected'>{{$selectedItems["thana"]}}</option>");
    }else{
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
                                $("#thana").html('');   //this line clears all option entry if any
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
    }
        
        
//        Change See More Buten Text
        function changeBtnTxt(){
            
            var target= event.target || event.srcElement;
            var id = target.id;
            var txtElem = document.getElementById(id);               
            var text = txtElem.textContent || txtElem.innerText;
            
            if (text.includes("See more")) {
                
                txtElem.innerHTML = "See less <html>&#9651;</html>";

            }else{
                
                txtElem.innerHTML = "See more <html>&#9661;</html>";

            }
        } 
        
//        add district and thana data with page link
        function passFilter(pageUrl){
            this.event.preventDefault();
            var specialtyName = document.getElementById('specialty').value;
            var districtName = document.getElementById('district').value;
            var thanaName = document.getElementById('thana').value;
            var areaName = document.getElementById('area').value;
            
            if(!specialtyName){
                specialtyName = null;
            }
            
            if(!districtName){
                districtName = null;
            }
            
            if(!thanaName){
                thanaName = null;
            }
            
            if(!areaName){
                areaName = null;
            }
            
            var pageUrlComplete = pageUrl + "/" + specialtyName + "/" + districtName + "/" + thanaName + "/" + areaName;
            window.location = pageUrlComplete;
            

        }
        
         
    </script>
@endsection
