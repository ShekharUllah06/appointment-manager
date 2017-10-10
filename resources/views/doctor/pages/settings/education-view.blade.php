@extends('doctor.pages.settings.education')
@section('title', 'Education List View')
@section('description', 'This is the Education page')

@section('educationHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Education List View</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
@endsection

@section('educationBody')

<div class="row" style="background-color: #f5f5f5;">
    
    <!--Page Title and Add New button-->
    <header class="row" style=" margin: 0px;">
        <h2 class="col-sm-5" style="margin-left: 0px; margin-top: 10px;">Education Card</h2>
        <div class="col-sm-1"></div>
            <a href="{{url('doctor/settings/education/new')}}" style="float: right;">
                <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px; margin-right: 5px;" />
            </a>
        </a>
    </header>
    
    <!--main section and/or cards section--->
    <div class="list-section row" style="margin: 0px;">
        <ul class="list-unstyled col-md-10 col-md-offset-1" style="background-color: white;">
        <!--Loop through education data array-->
            @foreach($educations as $education)
            <li>
                    <div class="card row" style="border-bottom: 1px solid black;">   
                        <!--Left side Logo-->
                        <img src="{{url('assets/img/educationLogo.png')}}" class="left-image-column col-sm-2" alt="education logo" height="100" width="100" style="margin-top:4px;"> 
                        
                         <!--Right Side Edit Button-->
                        <a href="{{ url('doctor/settings/education/edit', ['degreeName' => $education->degree_name])}}" style="float: right; padding-right: 10px; padding-top: 10px;">
                            <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit education" height="35px" width="35px" style="float: right;"/>
                        </a>
                         
                        <div class="middle-info-coloumn col-sm-7" style="margin-left: 5px; padding-right:5px;">
                            <div class="title-info row" style="margin:0px;">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    {{ $education->degree_name }}
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->
                                    {{ $education->institute_name }}
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row"  style="margin:0px;">   <!--Under Secondary title--> 
                                <p class="col-sm-12" style="padding-left: 0px">   <!--first part, at left--> 
                                    <span class="glyphicon glyphicon-calendar">
                                        Year Passed: {{ $education->pass_year }}
                                    </span>
                                </p>
                            </div> <!-- End multi-info class-->
                        </div> <!-- End middle class-->
                    </div> <!--End Card class-->
                </li> <!--End card item-->
            @endforeach <!--End education data array Loop -->
        </ul>
    </div>  
</div>

@endsection
 