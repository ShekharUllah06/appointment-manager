@extends('layouts.front')

@section('content')

    <div class="container-fluid row3">                        
        <div class="row page-header">
            
            <!--left side blank space holder-->
            <div class= "col-md-1"></div>
            
            <!--Info section start-->
            <div class="col-md-7">
                <div class="row">
                    <!--Profile Image-->
                    <div class="col-md-4" style="text-align: right;">
                        <img src="{{ url('storage/uploads/avatars/'.$personal_info->imageUrl) }}" alt="Doctor Profile Picture" style="width: 150px; height: 150px; border-radius: 20%; padding-right: 0px; margin-right: 0px;"/>
                    </div>
                    <!--Short Description at top-->
                    <div class="col-md-6" style="text-align: left;">
                        <div class="row">
                            <h4>
                                <b>
                                    <?php if($user->first_name){ echo(ucfirst($user->first_name)); } ?> 
                                        <?php if($user->last_name){ echo(ucwords($user->last_name)); } ?>
                                </b>
                            </h4>
                        </div>
                        <div class="row">
                            @if(count($work_histories) < 1)
                                Work history Information not yet submitted.
                            @else
                                @foreach($work_histories as $work_history)
                                    @if($work_history->current_position)
                                        <span style="">
                                            <b>{{ $work_history->position }},</b> 
                                            At: <b>{{$work_history->organization}}</b>
                                        </span>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            @if(count($educations) < 1)
                                Education Information not yet submitted.
                            @else
                                @foreach($educations as $education)
                                    <span style="">
                                        <b>{{ $education->degree_name }},</b>
                                    </span>

                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            @if(count($specialties) < 1)
                                Specialties Information not yet submitted.
                            @else
                                @foreach($specialties as $specialty)
                                    <span style="">
                                        <b>{{ $specialty->specialty }},</b>
                                    </span>

                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                
                <!--Detailed Info -->
                <div class="row">
                    <div class="col-md-8" style="text-align: left; margin: 15px; padding: 15px;">
                        <label>Work History</label>
                        @if(count($work_histories) < 1)
                            Information yet submitted.
                        @else
                            @foreach($work_histories as $work_history)
                            <div class="row" style="margin: 5px; padding: 5px; border-bottom: 1px black solid;">
                                <!--Left side Logo-->
                                <div class="col-md-2">
                                    <img src="{{ url('assets/img/workHistoryLogo.png') }}" alt="add new" height="50" width="50" style="margin-top: 10px; margin-right: 5px;" />
                                </div>
                                <div class="col-md-8">
                                    <span style=""><b>{{ $work_history->position }}</b></span> <br />
                                                                    {{ $work_history->organization }} <br />
                                    <span style="">{{ $work_history->start_date }} 
                                        to <?php if($work_history->current_position){ echo("Current"); }
                                                    else{echo($work_history->end_date);} ?>
                                    </span>
                                    <br />

                                    <button id="see{!! $work_history->work_history_id !!}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{!! $work_history->work_history_id !!}" aria-expanded="false" aria-controls="{!! $work_history->work_history_id !!}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                        See more
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8" style="text-align: left; margin-top: 5px; margin-left: 15px; margin-right: 15px; margin-bottom: 15px; padding: 15px;">
                        <label>Education</label>

                        @if(count($educations) < 1)
                            Information not yet submitted.
                        @else
                            @foreach($educations as $education)
                            <div class="row" style="margin: 5px; padding: 5px; border-bottom: 1px black solid;">
                                <!--Left side Logo-->
                                <div class="col-md-2">
                                    <img src="{{ url('assets/img/educationLogo.png') }}" alt="education logo" height="62" width="53" style="margin-top:4px;"> 
                                </div>
                                <div class="col-md-8">
                                    <span style="color: dimgray; font-size: 17px"><b>{{ $education->degree_name }}</b></span> <br />
                                       {{ $education->institute_name }} <br />
                                       <table style="margin-top: 5px; font-size: 11px;">
                                           <tr>
                                               <td style="border: 1px solid black; padding-top: 4px; padding-bottom: 4px; padding-left: 8px; padding-right: 8px;">Icon</td>
                                               <td style="border: 1px solid black; padding-top: 4px; padding-bottom: 4px; padding-left: 8px; padding-right: 8px;">Year Passed: {{ $education->pass_year }}</td>
                                           </tr>
                                       </table>
                                    <br />                               
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            
            <!--Calander Section (at right side) start-->
            <div class="col-md-3">
                <h4 style="">Schedule Calender</h4>
                <div class="panel panel-default">
                    <table class="table table-bordered" style="font-size: 11px; background-color: inherit; text-align: center; color: inherit;">
                        <thead>  
                            <th style="background-color: lightgreen; text-align: center; padding: 3px;"><a href="{{ url('#') }}"><h6 style="color: black;"><b> &#9664; </b></h6></a></th>
                            <th colspan="5" style="background-color: lightblue; color: black; font-size: 18px; text-align: center; padding: 3px;">{{ $calender['monthName'] }} - {{ $calender['year']}}</th>
                            <th style="background-color: lightgreen; text-align: center; padding: 3px;"><a href=" {{ url('#') }}"><h6 style="color: black;"><b> &#9654; </b></h6></a></th>
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
                       @for($i = 0; $i < count($calender['calender']); $i++)                   
                            <tr>
                                <?php $countDayInWeek = count($calender['calender'][$i]);

                                    for($j = 0; $j < $countDayInWeek; $j++){
                                ?>
                                    <td style='padding: 2px;'>
                                        @if((array_search($calender['calender'][$i][$j], $calender['calender'][$i]) == 5) || (isset($calender['calender'][$i][$j]['date']) && ($calender['calender'][$i][$j]['date'] == 5))) 
                                            @if(isset($calender['calender'][$i][$j]['date']))
                                                <span style="">
                                                    {{ $calender['calender'][$i][$j]['date'] }}
                                                </span>
                                                <div style="font-size: 9.5px; background-color: yellowgreen;"> 
                                                    <span style="color: blue;">
                                                        <?php if(isset($calender['calender'][$i][$j]['chamberName'])){ print ($calender['calender'][$i][$j]['chamberName'] . ", ");} ?>
                                                    </span>
                                                    <?php if(isset($calender['calender'][$i][$j]['startTime'])){ print ($calender['calender'][$i][$j]['startTime']); print "-"; }  ?>
                                                    <?php if(isset($calender['calender'][$i][$j]['endTime'])){ print ($calender['calender'][$i][$j]['endTime'] . ", ");} ?>
                                                    <?php if(isset($calender['calender'][$i][$j]['consultFee'])){ print ("Fee - " . $calender['calender'][$i][$j]['consultFee'] . "/-");} ?>
                                                </div>    
                                            @else
                                                <span style="color: red">
                                                    {{ $calender['calender'][$i][$j] }}
                                                </span>
                                            @endif
                                        @else

                                            @if(isset($calender['calender'][$i][$j]['date']))

                                                {{ $calender['calender'][$i][$j]['date'] }}
                                                <div style="font-size: 9.5px; background-color: yellowgreen;"> 
                                                    <span style="">
                                                        <?php if(isset($calender['calender'][$i][$j]['chamberName'])){ print ($calender['calender'][$i][$j]['chamberName'] . ", ");} ?>
                                                    </span>
                                                    <?php if(isset($calender['calender'][$i][$j]['startTime'])){ print ($calender['calender'][$i][$j]['startTime']); print "-"; }  ?> 
                                                    <?php if(isset($calender['calender'][$i][$j]['endTime'])){ print ($calender['calender'][$i][$j]['endTime'] . ", ");} ?>
                                                    <?php if(isset($calender['calender'][$i][$j]['consultFee'])){ print ("Fee - " . $calender['calender'][$i][$j]['consultFee'] . "/-");} ?>
                                                </div>    
                                            @else
                                                {{ $calender['calender'][$i][$j] }}
                                            @endif
                                        @endif

                                    </td>
                                <?php } ?>
                            </tr>
                        @endfor
                        <tr>
                            <td colspan="7" style="">
                                <span style="">***</span> Schedule Dates are marked with "<span style="">Chamber name</span>", "<span style="">Start Time</span>", "<span style="">End Time</span>" and "<span style="">End Time</span>", and with <span style="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> color in background below the Date. If you don't see any such texts, then there is no schedule in this month.
                            </td>
                        </tr>

                    </table>   
                </div>
            </div>
            <!--right side blank space holder-->
            <div class= "col-md-1"></div>
        </div>
        
        <div class="row">
            <div class="col-md-4"><a href='/'><button class='btn btn-primary'>Back</button></a></div>    
        </div>
    </div>


@endsection

@section('jscript')

<script type='text/javascript'> 
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