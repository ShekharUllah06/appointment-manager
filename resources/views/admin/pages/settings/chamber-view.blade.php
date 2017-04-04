@extends('admin.pages.settings.chamber')
@section('title', 'Chamber List View')
@section('description', 'This is the Chamber page')

@section('chamberHead')

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Chamber List View
        </li>
    </ol>
        @include('notifications.status_message')
        @include('notifications.errors_message') 
        
@endsection

@section('chamberBody')
<div class="col-md-1></div>
<div class="col-md-11 row" style="background-color: #f5f5f5 ">
    <span>
        <section>
            <header class="row">
                <h2 class="col-md-3" style="margin-left: 20px">Chamber Card</h2>
                <div class="col-md-8"></div>
                    <span style="margin-right:  15px; padding-right: 15px; float: right;">
                        <a href="{{url('admin/settings/chamber/new')}}">
                            <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px; margin-left: 10px">
                        </a>
                    </span>
                </a>
            </header>
            <div class="list-section row">
                <div class="col-md-1"></div>  <!--Left Space Holder-->
                
                <ul class="list-unstyled col-md-10" style="background-color: white">
                    
                    
              <!--Check if chamber data exists-->
              
                @if(isset($chambers)) 
                
              <!--Loop through chamber data array-->
                    @foreach($chambers as $chamber)

                    <li>
                            <div class="card row" style="border-right: 2px solid black; border-bottom: 2px solid black; padding-bottom: 3px;">   <!--Right Side edit button-->
                                <div class="left-image-column col-md-2">
                                   <div>   <!--Left Side Card Image-->
                                       <br>
                                       <img src="{{url('assets/img/chamberLogo.png')}}" alt="chabmer logo" height="100" width="100">
                                    </div>
                                </div> <!--End left-image-column class--> 
                                <div class="middle-info-coloumn col-md-9">
                                    <div class="title-info row">
                                    <!--Card Visible Portion. At Right side of Card Image-->
                                        <h3> <!--Card Title-->
                                            {{$chamber->chamber_name }}
                                        </h3>
                                        <h4>   <!--Secondary title or Under Card Title--> 
                                            <span></span>
                                            <span>
                                                ID - {{ $chamber->chamber_id }}
                                            </span>
                                        </h4>
                                        </div> <!--End title-info class--> 

                                        <div class="multi-info row">   <!--Under Secondary title--> 
                                            <p class="col-md-4" style="padding-left: 0px">   <!--first part, at left--> 
                                                <span></span>
                                                <span class="glyphicon glyphicon-phone">
                                                    {{ $chamber->telephone_number1 }}
                                                </span>
                                            </p>
                                            <p class="col-md-4">   <!--second part, at right side of first part--> 
                                                <span></span>
                                                <span class="glyphicon glyphicon-phone-alt">
                                                    {{ $chamber->mobile_number1 }}
                                                </span>
                                            </p>
                                            <p class="col-md-4">   <!--second part, at right side of first part--> 
                                                <span></span>
                                                <span class="glyphicon glyphicon-phone-alt">
                                                    {{ $chamber->mobile_number2 }}
                                                </span>
                                            </p>

                                        </div> <!-- End multi-info class-->
                                        <div class="{{ $chamber->chamber_id }} row" style="margin-top: 10px;">
                                            <p class="collapse" id="{{ $chamber->chamber_id }}">
                                            <table class="table">
                                                    <tr>
                                                        <td>Institute Name:</td><td>{{ $chamber->institute }}</td>
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
                                            </p>
                                            <button id="seeMoreBTN" data-toggle="collapse" data-target="#{{ $chamber->chamber_id }}" aria-expanded="false" aria-controls="{{ $chamber->chamber_id }}" style="border:none; background-color: white; color: gray; margin-top: 5px; margin-bottom: 10px;">
                                                        See more
                                                        <span class="glyphicon glyphicon-chevron-down" style="padding:4px; margin-top: 2px;"></span>
                                                    <span></span>
                                                </button>

                                        </div> <!-- End description class-->
                                    </div> <!-- End middle class-->

                                    <div class="description" style="margin: 7px; padding: 7px; float: right;">
                                        <a href="{{ url('admin/settings/chamber/edit', ['cId' => $chamber->chamber_id])}}">
                                            <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit chamber" height="35px" width="35px">
                                        </a>
                                    </div>
                                <!--</div>-->
                            </div> <!--End Card class-->
                        </li> <!--End card item-->

                    @endforeach <!--End chamber data array Loop -->
                    
                <!--If no chamber data found-->
                @else
                    <div>
                        <h3 style="color: brown">No Chamber Data found in database. Please click add (+ icon) on Upper Right side of this message to Add chamber information.</h3>
                    </div>
                @endif <!--End chamber data check-->
                
                </div> <!--End list-section class-->
                </ul>
                <div class="col-md-1"></div> <!--Right Space Holder-->
            </div>  

        </section>
    </span>   
</div>


<!--    <script type='text/javascript'>//<![CDATA[ 
        $(window).load(function(){
        $(document).ready(function () {
            $("#seeMoreBTN").button();
            $("#seeMoreBTN").click(function () {
                $(this).button('loading');
                setTimeout(function () {
                    $("#seeMoreBTN").button('reset').addClass("btn-success");
                }, 2000);
            });
        });
        });//]]>  
    </script>-->


@endsection

@section('script')


    
endsection