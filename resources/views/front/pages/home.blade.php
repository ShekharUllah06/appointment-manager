    @extends('layouts.front')

    @section('content')
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h2 id="homeHeading">Welcome to Doctor's On-Line Appoint-Manager App</h2>
                    <hr>
                                    @include('notifications.status_message')
                                    @include('notifications.errors_message')
                                    <p>This is your Appointment Management App which Doctors can use to manage their schedules and Patients can use to book an Appointment.
                    
                    <div class="col-md-8">                    
                        <a href="{{ url('/doctor_profile', ["doctorID" => '1', "calanderMonth" => '2017-12-31']) }}"><button class="btn btn-primary">Doctor's Profile</button></a>
                    </div>               
                    <div class="col-md-4" style="border: 1px black solid; float: right;">
                        <label for='doctorLogin'>Doctor's Section</label>
                        <div id='doctorLogin'>
                            <a href="{{ url('/register')}}">Register now</a> to start using. Its completely free.</p>
                            <a href="{{ url('/login') }}" class="btn btn-primary btn-xl page-scroll">Login</a>  <a href="{{ url('/register') }}" class="btn btn-danger btn-xl page-scroll">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>




    @endsection