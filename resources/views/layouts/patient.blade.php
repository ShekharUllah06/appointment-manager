<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title>@yield('title')</title>
	
	<meta name="description" content="@yield('description')">

    <!-- Bootstrap Core CSS -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Custom CSS -->
    <link href="{!! asset('assets/css/admin.css') !!}" rel="stylesheet">
    <link href="{!! asset('assets/css/zakiStyle.css') !!}" rel="stylesheet">
	
	<!-- Morris Charts CSS -->
    <link href="{!! asset('assets/css/plugins/morris.css') !!}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>


</head>

<body>
    <?php $url = $_SERVER['REQUEST_URI'];?>     <!--Get Current URL for menu selection-->
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Appointment Manager</a>
            </div>
            
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    
                    @if (Auth::guest())
                        <a href="#"><i class="fa fa-user"></i> Unknown User</a>
                    
                    @else
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{!! url('/doctor/blank') !!}"><i class="fa fa-fw fa-user"></i>Edit Profile</a>
                            </li>

                            <li class="divider"></li>
                            <li>
                                <a href="{!! url('/logout') !!}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="fa fa-fw fa-power-off"></i> Log Out
                                </a>

                                <form id="logout-form" action="{!! url('/logout') !!}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>	
                    @endif
                    
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="">
                        <a href="{!! url('/patient') !!}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <?php if(strpos($url, '/patient/search') !== false){ ?>     <!--Menu selected Highlight-->
                        <li class="active">
                    <?php }else{ ?>
                        <li>
                    <?php } ?>
                        <a href="{!! url('/patient/search') !!}"><i class="glyphicon glyphicon-search"></i> Search or Browse Doctor</a>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
                        <!--// All the Contents goes here-->
			@yield('content')

        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- in page scripts -->
    @yield('jscriptPatient')

 
    <!-- Plugin JavaScript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
    <!-- Morris Charts JavaScript -->
<!--    <script src="{!! asset('assets/js/plugins/morris/raphael.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/morris/morris.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/morris/morris-data.js') !!}"></script>-->
</body>

</html>