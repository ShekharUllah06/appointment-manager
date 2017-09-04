@extends('layouts.front')

@section('content')

<header>
    <div class="container-fluid">
        <div class="row page-header">
            

            <div class="col-md-8">
                <div class="col-md-4">
                    <img class="col-md-4" src="{{ url('uploads/avatars/1.png') }}" alt="Profile Picture" style="width:160px; height:160px; border-radius:100%; margin:5px; padding-bottom: 2px;"/>
                </div>
                <div class="col-md-8">
                    Info
                </div>
                
            </div>
            <div class="col-md-4"><h2 style="color: chocolate; margin-top: -20px;">Schedule Calender</h2>
                <table class="table table-bordered">
                    <thead>  
                        <tr><th><a href=" {{ url('#') }}"><h3 style="text-align: center; color: gray; margin-top: -2px;"><b><<</b></h3></a></th><th colspan="5"><h3 style="text-align: center; color: #1b6d85; margin-top: -2px;">{{ $calender['monthName'] }} - {{ $calender['year']}}</h2></th><th><a href=" {{ url('#') }}"><h3 style="text-align: center; color: gray; margin-top: -2px;"><b>>></b></h2></a></th></tr>
                    </thead>                    
                    <tr>
                        <td colspan="7" style="font-size: smaller">
                            <span style="color: red">***</span> Schedule Dates are marked with "<span style="color: blue">Chamber name</span>", "<span style="color: blue">Start Time</span>" and "<span style="color: blue">End Time</span>", and with <span style="background-color: yellowgreen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> color in background below the Date. If you don't see any such texts, then there is no schedule in this month.
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
                                                    <?php if(isset($calender['calender'][$i][$j]['chamberName'])){ print ($calender['calender'][$i][$j]['chamberName']);} ?>
                                                </span>
                                                <?php if(isset($calender['calender'][$i][$j]['startTime'])){ print ($calender['calender'][$i][$j]['startTime']); print "-"; }  ?>
                                                    <?php if(isset($calender['calender'][$i][$j]['endTime'])){ print ($calender['calender'][$i][$j]['endTime']);} ?>
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
                                                    <?php if(isset($calender['calender'][$i][$j]['chamberName'])){ print ($calender['calender'][$i][$j]['chamberName']);} ?>
                                                </span>
                                                <?php if(isset($calender['calender'][$i][$j]['startTime'])){ print ($calender['calender'][$i][$j]['startTime']); print "-"; }  ?> 
                                                    <?php if(isset($calender['calender'][$i][$j]['endTime'])){ print ($calender['calender'][$i][$j]['endTime']);} ?>
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
            <div class="col-md-4">M-1</div>
            <div class="col-md-4">M-2</div>
            <div class="col-md-4">M-3</div>
        </div>
        <div class="row">
            <div class="col-md-4">B-1</div>
            <div class="col-md-4">B-2</div>
            <div class="col-md-4"><a href='/'><button class='btn btn-primary'>Home</button></a></div>           
        </div>
    </div>
</header>
@endsection