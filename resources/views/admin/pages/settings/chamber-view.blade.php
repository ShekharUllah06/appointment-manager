@extends('admin.pages.settings.chamber')
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

<div class="col-md-auto row" style="background-color: #f5f5f5 ">
    <header class="row">
        <h2 class="col-sm-5" style="margin-left: 20px; margin-top: 10px;">Chamber Card</h2>
        <div class="col-sm-1"></div>
            <span style="margin-right: 15px; padding-right: 15px; float: right;">
                <a href="{{url('admin/settings/chamber/new')}}" style="float: right;">
                    <img src="{{url('assets/img/plus-t-2.png')}}" alt="add new" height="50px" width="50px" style="margin-top: 10px;" />
                </a>
            </span>
        </a>
    </header>
    <div class="list-section row" style="margin: 0px">
        <div class="col-md-1"></div>  <!--Left Space Holder-->

        <ul class="list-unstyled col-md-10" style="background-color: white">
        <!--Loop through chamber data array-->
            @foreach($chambers as $chamber)
                <li>
                    <div class="card row" style="border-right: 2px solid black; border-bottom: 2px solid black; padding-bottom: 1px;">   <!--Right Side edit button-->
                        <div class="left-image-column col-lg-2">
                           <div>   <!--Left Side Card Image-->
                               <br>
                               <img src="{{url('assets/img/chamberLogo.png')}}" alt="chabmer logo" height="100" width="100">
                            </div>                            
                        </div> <!--End left-image-column class--> 
                        
                         <!--Edit Button-->
                        <div class="description col-sm-1" style="margin: 7px; padding: 7px; float: right;">
                            <a href="{{ url('admin/settings/chamber/edit', ['cId' => $chamber->chamber_id])}}" style="float: right">
                                <img src="{{url('assets/img/edit-t-1.png')}}" alt="edit chamber" height="35px" width="35px" />
                            </a>
                        </div>
                        <div class="middle-info-coloumn col-md-8" style="margin-left: 5px; padding-right:5px;">
                            <div class="title-info row">
                            <!--Card Visible Portion. At Right side of Card Image-->
                                <h3> <!--Card Title-->
                                    {{$chamber->chamber_name }}
                                </h3>
                                <h4>   <!--Secondary title or Under Card Title-->
                                    <span>
                                        ID - {{ $chamber->chamber_id }}
                                    </span>
                                </h4>
                            </div> <!--End title-info class--> 
                            <div class="multi-info row">   <!--Under Secondary title--> 
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
                            </div> <!-- End multi-info class-->
                            <div class="row" style="margin-top: 10px;">
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
.
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
 