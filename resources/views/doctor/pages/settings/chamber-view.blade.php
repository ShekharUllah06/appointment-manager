@extends('doctor.pages.settings.chamber')
@section('title', 'Chamber List View')
@section('description', 'This is the Chamber page')

@section('chamberHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"> Chamber List View</i>
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
@endsection

@section('chamberBody')

<div class="row" style="background-color: #f5f5f5 ">
    
    <!--Page Title and Add New button-->
    <header class="row"  style=" margin: 0px;">
        <h2 class="col-sm-5" style="margin-left: 0px; margin-top: 10px;">Chamber Card</h2>
        <div class="col-sm-1"></div>
            <a href="{{url('doctor/settings/chamber/new')}}" style="float: right;">
                <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px; margin-right: 5px;" />
            </a>
        </a>
    </header>
    
    <!--main section and/or cards section-->
    <div class="list-section row" style="margin: 0px">        
        <ul class="list-unstyled col-md-10 col-md-offset-1" style="background-color: white;">
        <!--Loop through chamber data array-->
            @foreach($chambers as $chamber)
                <li>
                    <div class="card row" style="border-bottom: 1px solid black;">   
                        <!--Left side Logo-->
                        <img src="{{url('assets/img/chamberLogo.png')}}" class="left-image-column col-sm-2" alt="chabmer logo" height="100" width="100" style="margin-top:10px;">
                        
                        <!--Right Side Edit Button-->
                        <a href="{{ url('doctor/settings/chamber/edit', ['cId' => $chamber->chamber_id])}}" style="float: right; padding-right: 10px; padding-top: 10px;">
                            <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit chamber" height="35px" width="35px" style="float: right;" />
                        </a>
                        <div class="middle-info-coloumn col-sm-8" style="margin-left: 5px; padding-right:5px;">
                            <div class="title-info row" style="margin:0px;">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    {{$chamber->chamber_name }}
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->
                                    ID - {{ $chamber->chamber_id }}
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row" style="margin:0px; border">   <!--Other Informations--> 
                                <p class="col-sm-4" style="padding-left: 0px">   <!--first part, at left--> 
                                    <span class="glyphicon glyphicon-phone">
                                        {{ $chamber->telephone_number1 }}
                                    </span>
                                </p>
                                <p class="col-sm-4" style="padding-left: 0px">   <!--second part, at right side of first part--> 
                                    <span class="glyphicon glyphicon-phone-alt">
                                        {{ $chamber->mobile_number1 }}
                                    </span>
                                </p>
                                <p class="col-sm-4" style="padding-left: 0px">   <!--second part, at right side of first part--> 
                                    <span class="glyphicon glyphicon-phone-alt">
                                        {{ $chamber->mobile_number2 }}
                                    </span>
                                </p>
                            </div> <!--End Other Informations--> 
                            <div class="row" style="margin-top: 10px;"> <!--hidden section-->
                                <div class="collapse" id="sec{{ $chamber->chamber_id }}" style="margin-right: 10px;">
                                    <table class="table">
                                            <tr>
                                                <td>Institute Name:</td> <td>{{ $chamber->institute }}</td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Number-2:</td> <td>{{ $chamber->telephone_number2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Telephone Number-3:</td> <td>{{ $chamber->telephone_number3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Mobile Number-3:</td> <td>{{ $chamber->mobile_number3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>Thana(Police Station) Name:</td> <td>{{ $chamber->thana }}</td>
                                            </tr>
                                            <tr>
                                                <td>Post Code:</td> <td>{{ $chamber->post_code }}</td>
                                            </tr>
                                            <tr>
                                                <td>City:</td> <td>{{ $chamber->city }}</td>
                                            </tr>
                                            <tr>
                                                <td>District:</td> <td>{{ $chamber->district }}</td>
                                            </tr>
                                            <tr>
                                                <td>Address:</td> <td>{{ $chamber->address }}</td>
                                            </tr>
                                        </table>
                                </div>
                                <button id="see{{ $chamber->chamber_id }}" onclick="changeBtnTxt()" data-toggle="collapse" data-target="#sec{{ $chamber->chamber_id }}" aria-expanded="false" aria-controls="{{ $chamber->chamber_id }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 5px; text-decoration: underline;">
                                    See more
                                </button>
<!--<span class="glyphicon glyphicon-chevron-down" style="padding:4px; margin-top: 2px;"></span>-->

                            </div> <!-- End description class-->
                        </div> <!-- End middle class-->
                    </div> <!--End Card class-->
                </li> <!--End card item-->
            @endforeach <!--End chamber data array Loop -->
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
 