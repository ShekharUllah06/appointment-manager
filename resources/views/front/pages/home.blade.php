    @extends('layouts.front')

    @section('content')
        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading">Welcome to Appoint-Manager On-Line App</h1>
                    <hr>
                                    @include('notifications.status_message')
                                    @include('notifications.errors_message')
                                    <p>This is your Appointment Management App which you can use to manage your appointments. <a href="{{ url('/register')}}">Register now</a> to start using. Its completely free.</p>
                    <a href="{{ url('/login') }}" class="btn btn-primary btn-xl page-scroll">Login</a>  <a href="{{ url('/register') }}" class="btn btn-danger btn-xl page-scroll">Register</a>
                </div>
            </div>
        </header>




    @endsection