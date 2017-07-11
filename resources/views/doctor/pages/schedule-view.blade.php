@extends('doctor.pages.schedule')
@section('title', 'Schedule List View')
@section('description', 'This is the Schedule page')

@section('scheduleHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Schedule List View</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
@endsection

@section('scheduleBody')

<div class="row" style="background-color: #f5f5f5">
    
    <!--Page Title and Add New button-->
    <header class="row"  style=" margin: 0px;">
        
        <div class="col-sm-5"></div>

        <h2 style="margin-left: 15px; margin-top: 10px;">Schedule Card
            <a href="{{url('doctor/schedule/new')}}">
                <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style=" margin-left: 7px; border: 1px lightgray solid; padding: 1px;" />
            </a>
        </h2>   
        
    </header>
    
    <!--main section and/or cards section--->   
    <div class="list-section row" style="margin: 0px">        
        <ul class="list-unstyled col-md-10 col-md-offset-1" style="background-color: white;">
            <!--Loop through schedule data array-->
            
             @foreach($schedules as $schedule)
                <li>
                    <div class="card row" style="border-bottom: 1px solid black;">   
                        
                        <!--Right Side Edit Button-->
                        <a href="{{ url('doctor/schedule/edit', ['scheduleId' => $schedule->schedule_id])}}" style="float: right; padding-right: 10px; padding-top: 10px;">
                            <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit schedule" height="35px" width="35px" style="float: right;" />
                        </a>
                        <div class="middle-info-coloumn col-sm-10" style="margin-left: 5px; margin-bottom: 8px; padding-right:5px;">
                            <div class="title-info row" style="margin:0px;">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    Date: <b>{{ $schedule->schedule_date }}</b>
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->
                                    Chamber Name: <b>{{ $schedule->chamber_name }}</b>
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row" style="margin:0px;">   <!--Other Informations--> 
                                <p class="col-sm-4" style="padding-left: 0px">   <!--first part, at left--> 
                                    <span class="glyphicon glyphicon-phone">
                                     Chamber ID: <b>{{ $schedule->chamber_id }}</b>
                                    </span>
                                </p>
                                <p class="col-sm-4" style="padding-left: 0px">   <!--second part, at right side of first part--> 
                                    <span class="glyphicon glyphicon-time">
                                        Start: <b>{{ $schedule->start_time }}</b>
                                    </span>
                                </p>
                                <p class="col-sm-4" style="padding-left: 0px">   <!--second part, at right side of first part--> 
                                    <span class="glyphicon glyphicon-time">
                                         End: <b>{{ $schedule->end_time }}</b>
                                    </span>
                                </p>
                            </div> <!--End Other Informations--> 
                            <div class="row"> <!--hidden section-->
                                <div class="col-sm-5">
                                    <span class="glyphicon glyphicon-map-marker">
                                        District: <b>{{ $schedule->district }}</b>
                                    </span>                            
                                </div>
                                <div class="col-sm-5" id="">
                                    <span class="glyphicon glyphicon-map-marker">
                                        Thana/Sub-Distric: <b>{{ $schedule->thana }}</b>
                                    </span>

<!--<span class="glyphicon glyphicon-chevron-down" style="padding:4px; margin-top: 2px;"></span>-->
                            </div> <!-- End description class-->
                        </div> <!-- End middle class-->
                    </div> <!--End Card class-->
                </li> <!--End card item-->
            @endforeach <!--End schedule data array Loop -->

        </ul>
    </div>  
</div>

@endsection


 
