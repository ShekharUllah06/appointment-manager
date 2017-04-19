@extends('admin.pages.settings.work-history')
@section('title', 'work-history List View')
@section('description', 'This is the work-history page')

@section('workHistoryHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Work History List View</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
@endsection

@section('workHistoryBody')

<div class="row" style="background-color: #f5f5f5 ">
    
    <!--Page Title and Add New button-->
    <header class="row"  style=" margin: 0px;">
        <h2 class="col-sm-5" style="margin-left: 0px; margin-top: 10px;">Work History Card</h2>
        <div class="col-sm-1"></div>
            <a href="{{url('admin/settings/work-history/new')}}" style="float: right;">
                <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px; margin-right: 5px;" />
            </a>
        </a>
    </header>
    
    <!--main section and/or cards section-->
    <div class="list-section row" style="margin: 0px">        
        <ul class="list-unstyled col-md-10 col-md-offset-1" style="background-color: white;">
        <!--Loop through work history data array-->
            @foreach($work_history as $work_history_item)
                <li>
                    <div class="card row" style="border-bottom: 1px solid black;">   
                        <!--Left side Logo-->
                        <img src="{{url('assets/img/workHistoryLogo.png')}}" class="left-image-column col-sm-2" alt="work histor logo" height="100" width="100" style="margin-top:10px;">
                        
                        <!--Right Side Edit Button-->
                        <a href="{{ url('admin/settings/work-history/edit', ['WorkHistoryId' => $work_history_item->work_history_id])}}" style="float: right; padding-right: 10px; padding-top: 10px;">
                            <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit Work history" height="35px" width="35px" style="float: right;" />
                        </a>
                        <div class="middle-info-coloumn col-sm-7" style="margin-left: 5px; padding-right:5px;">
                            <div class="title-info row" style="margin:0px;">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    {{ $work_history_item->position }}
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->                                    
                                    {{ $work_history_item->organization }}                                   
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row" style="margin:0px;">   <!--Other Informations--> 
                                <p class="col-sm-6" style="padding-left: 0px">   <!--first part, at left--> 
                                    <span class="glyphicon glyphicon-calendar">
                                        Start Date - {{ $work_history_item->start_date }}
                                    </span>
                                </p>
                                <p class="col-sm-6" style="padding-left: 0px">   <!--second part, at right side of first part--> 
                                    <span class="glyphicon glyphicon-calendar">
                                        End Date - {{ $work_history_item->end_date }}
                                    </span>
                                </p>
                            </div> <!--End Other Informations--> 
                            <div class="row" style="margin-top: 10px;"> <!--hidden section-->
                                <div class="collapse" id="sec{{ $work_history_item->work_history_id }}" style="margin-right: 10px;">
                                    <p>Job Description: {{ $work_history_item->description }}</p>
                                </div>
                                <button id="see{{ $work_history_item->work_history_id }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $work_history_item->work_history_id }}" aria-expanded="false" aria-controls="{{ $work_history_item->work_history_id }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                    See more
                                </button>
<!--<span class="glyphicon glyphicon-chevron-down" style="padding:4px; margin-top: 2px;"></span>-->

                            </div> <!-- End description class-->
                        </div> <!-- End middle class-->
                    </div> <!--End Card class-->
                </li> <!--End card item-->
            @endforeach <!--End work-history data array Loop -->
        </ul>
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
 