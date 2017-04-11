@extends('admin.pages.settings.education')
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

<div class="col-md-auto row" style="background-color: #f5f5f5 ">
    
    <!--Page Title and Add New button-->
    <header class="row">
        <h2 class="col-sm-5" style="margin-left: 20px; margin-top: 10px;">Education Card</h2>
        <div class="col-sm-1"></div>
            <span style="margin-right: 15px; padding-right: 15px; float: right;">
                <a href="{{url('admin/settings/education/new')}}" style="float: right;">
                    <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px;" />
                </a>
            </span>
        </a>
    </header>
    
    <!--main section and/or cards section-->
    <div class="list-section row" style="margin: 0px">
        <div class="col-md-1"></div>  <!--Left Space Holder-->

        <ul class="list-unstyled col-md-10" style="background-color: white">
        <!--Loop through education data array-->
            @foreach($educations as $education)
                <li>
                    <div class="card row" style="border-right: 2px solid black; border-bottom: 2px solid black; padding-bottom: 10px;">   <!--Right Side edit button-->
                        <div class="left-image-column col-lg-2">
                           <div>   <!--Left Side Card Image-->
                               <br>
                               <img src="{{url('assets/img/educationLogo.png')}}" alt="education logo" height="100" width="100">
                            </div>                            
                        </div> <!--End left-image-column class--> 
                        
                         <!--Edit Button-->
                        <div class="description col-sm-1" style="margin: 7px; padding: 7px; float: right;">
                            <a href="{{ url('admin/settings/education/edit', ['degreeName' => $education->degree_name])}}" style="float: right">
                                <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit education" height="35px" width="35px" />
                            </a>
                        </div>
                        <div class="middle-info-coloumn col-md-8" style="margin-left: 5px; padding-right:5px;">
                            <div class="title-info row">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    {{$education->degree_name }}
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->
                                        {{ $education->institute_name }}
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row">   <!--Under Secondary title--> 
                                <p class="col-sm-4" style="padding-left: 0px">   <!--first part, at left--> 
                                    <span class="glyphicon glyphicon-phone">
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
 