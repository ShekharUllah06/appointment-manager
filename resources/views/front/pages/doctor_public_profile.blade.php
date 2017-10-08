@extends('layouts.front')

@section('content')

<header>
    <div class="container-fluid">
        <div class="row page-header">
            
            <!--Info section start-->
            <div class="col-md-7">
                <div class="row">
                    <!--Profile Image-->
                    <div class="col-md-4">
                        <img src="{{url('uploads/avatars/'.$personal_info->imageUrl)}}" alt="Profile Picture" style="width:160px; height:160px; border-radius: 20%;"/>
                    </div>
                    <!--Short Description-->
                    <div class="col-md-7" style="text-align: left;">
                        <div class="row">
                            <h4><b><?php if($user->first_name){echo(ucfirst($user->first_name));} ?> <?php if($user->last_name){echo(ucwords($user->last_name));} ?></b></h4>
                        </div>
                        <div class="row">
                            @foreach($work_histories as $work_history)
                                @if($work_history->current_position)
                                    <span style="border: 5px; padding: 5px;">
                                        <b>{{ $work_history->position }},</b> At: <b>{{$work_history->organization}}</b>
                                    </span>
                                @endif
                            @endforeach
                        </div>
                        <div class="row">
                            @foreach($educations as $education)
                                <span style="border: 5px; padding: 5px;">
                                    <b>{{ $education->degree_name }},</b>
                                </span>

                            @endforeach
                        </div>
                        <div class="row">
                            @foreach($specialties as $specialty)
                                <span style="border: 5px; padding: 5px;">
                                    <b>{{ $specialty->specialty }},</b>
                                </span>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8" style="text-align: left; margin: 15px; padding: 15px;">
                        <label>Work History</label>
                        @foreach($work_histories as $work_history)
                        <div class="row" style="margin: 5px; padding: 5px; border-bottom: 1px black solid;">
                            <!--Left side Logo-->
                            <div class="col-md-2">
                                <img src="{{url('assets/img/workHistoryLogo.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px; margin-right: 5px;" />
                            </div>
                            <div class="col-md-8">
                                <span style="color: dimgray; font-size: 17px"><b>{{ $work_history->position }}</b></span> <br />
                                                                {{ $work_history->organization }} <br />
                                <span style="font-size: 11px">{{ $work_history->start_date }} - <?php if(!$work_history->current_position){echo($work_history->end_date);} ?></span>
                                <br />
                                
                                <button id="see{{ $work_history->work_history_id }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $work_history->work_history_id }}" aria-expanded="false" aria-controls="{{ $work_history->work_history_id }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                    See more
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8" style="text-align: left; margin-top: 5px; margin-left: 15px; margin-right: 15px; margin-bottom: 15px; padding: 15px; ">
                        <label>Education</label>
                        @foreach($educations as $education)
                        <div class="row" style="margin: 5px; padding: 5px; border-bottom: 1px black solid;">
                            <!--Left side Logo-->
                            <div class="col-md-2">
                                <img src="{{url('assets/img/educationLogo.png')}}" alt="education logo" height="62" width="53" style="margin-top:4px;"> 
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
                    </div>
                </div>
            </div>
            
            <!--Calander Section start-->
            <div class="col-md-4"><h3 style="color: chocolate; margin-top: -20px;">Schedule Calender</h3>
                <table class="table table-bordered">
                    <thead>  
                        <tr><th><a href=" {{ url('#') }}"><h4 style="text-align: center; color: gray; margin-top: -2px;"><b><<</b></h4></a></th><th colspan="5"><h4 style="text-align: center; color: #1b6d85; margin-top: -2px;">{{ $calender['monthName'] }} - {{ $calender['year']}}</h4></th><th><a href=" {{ url('#') }}"><h4 style="text-align: center; color: gray; margin-top: -2px;"><b>>></b></h3></a></th></tr>
                    </thead>                    
                    <tr>
                        <td colspan="7" style="font-size: smaller">
                            <span style="color: red">***</span> Schedule Dates are marked with "<span style="color: blue">Chamber name</span>", "<span style="color: blue">Start Time</span>", "<span style="color: blue">End Time</span>" and "<span style="color: blue">End Time</span>", and with <span style="background-color: yellowgreen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> color in background below the Date. If you don't see any such texts, then there is no schedule in this month.
                        </td>
                    </tr>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th style="color: red">Fri</th>  
                            <th>Sat</th>
                    
                   @for($i = 0; $i < count($calender['calender']); $i++)                   
                        <tr>
                            <?php $countDayInWeek = count($calender['calender'][$i]);
                            
                                for($j = 0; $j < $countDayInWeek; $j++){
                            ?>
                                <td>
                                    @if((array_search($calender['calender'][$i][$j], $calender['calender'][$i]) == 5) || (isset($calender['calender'][$i][$j]['date']) && ($calender['calender'][$i][$j]['date'] == 5))) 
                                        @if(isset($calender['calender'][$i][$j]['date']))
                                            <span style="color: red">
                                                {{ $calender['calender'][$i][$j]['date'] }}
                                            </span>
                                            <div style="font-size: smaller; background-color: yellowgreen;"> 
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
                                            <div style="font-size: smaller; background-color: yellowgreen;"> 
                                                <span style="color: blue;">
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


                </table>   
            </div>
            
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4"><a href='/'><button class='btn btn-primary'>Home</button></a></div>           
        </div>
    </div>
</header>
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