<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
	
	<meta name="description" content="@yield('description')">

    <!-- Bootstrap Core CSS -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Custom CSS -->
    <link href="{!! asset('assets/css/admin.css') !!}" rel="stylesheet">
	
	<!-- Morris Charts CSS -->
    <link href="{!! asset('assets/css/plugins/morris.css') !!}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom CSS --->
    <link href="{{ asset('assets/css/zakiStyle.css') }}" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    


    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>


</head>

<body>
    <?php                                   //Check if user is Doctor or die!
    if(Auth::user()->userType !== 1){
        print("<h1 style='background-color: white; color: red;'>");
        exit("Illegal attempt to access unauthorized page!! Please go back to the login page to login again.");
        print("</h1>");
    }

//    $url = $_SERVER['REQUEST_URI'];         //Get Current URL for menu selection
    
    ?>
    <div id="wrapper">

        <!-- Navigation --->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                        <li>                    
                            <a href="{!! url('/doctor_profile', ['doctorID' => Auth::user()->id, 'calanderMonth' => ' ']) !!}"><i class="fa fa-fw fa-user"></i>View Profile as Visitor</a>
                        </li> 
                        <li class="divider"></li>
                        <li>
							<a href="{{ url('/logout') }}"
								onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
								<i class="fa fa-fw fa-power-off"></i> Log Out
							</a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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
                    <li id="dashboardMenuItem">
                        <a href="{{ url('/doctor') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <!--Schedule Menu Item-->
                    <li id="scheduleMenuItem">
                        <a href="{{ url('/doctor/schedule') }}"><i class="fa fa-fw fa-table"></i> Schedule</a>
                    </li>
                    
                    <!--Settings Menu Item-->
                   <li id = "settingCollapseMenuItemLI" class="collapsed" data-toggle="collapse" data-target="#submenu-collapse" aria-expanded='false'>

                        <a href="#"><i class="fa fa-fw fa-wrench"></i> Settings  <span class="caret" style="transform: rotate(-90deg);"></span></a>
                        <ul id="submenu-collapse" name="settingCollapseMenuItemUL" class="sub-menu collapse"  aria-expanded='false' style="height: 0px;">
                                                                 
                            <!--Chamber Sub-Menu Item-->
                            <li class="" id="chamberSubMenuItem">
                                <a href="{{ url('/doctor/settings/chamber') }}"><i class="glyphicon glyphicon-briefcase"></i> Chamber</a>
                            </li>
                            
                            <!--education Sub-Menu Item-->
                            <li class="" id="educationSubMenuItem">
                                <a href="{{ url('/doctor/settings/education') }}"><i class="glyphicon glyphicon-book"></i> Education</a>
                            </li>
                            
                            <!--personal-info Sub-Menu Item-->                            
                            <li class="" id="personalInfoSubMenuItem">
                                <a href="{{ url('/doctor/settings/personal-info') }}"><i class="glyphicon glyphicon-user"></i> Personal Info</a>
                            </li>
                            
                            <!--Specialty Sub-Menu Item-->  
                            <li class="" id="specialtySubMenuItem">
                                <a href="{{ url('/doctor/settings/specialties') }}"><i class="glyphicon glyphicon-list-alt"></i> Specialties</a>
                            </li>
                            
                            <!--work-history Sub-Menu Item-->  
                            <li class="" id="workHistoryPersonalSubMenuItem">
                                <a href="{{ url('/doctor/settings/work-history') }}"><i class="glyphicon glyphicon-list-alt"></i> Work History</a>
                            </li>
                        </ul>
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
        @yield('jscript')

        

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!--<script src="https://ajax.googleapis(.)com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->

    <!-- Plugin JavaScript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>-->
    
    <!-- Bootstrap Core JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
	<!-- Morris Charts JavaScript -->
    <script src="{!! asset('assets/js/plugins/morris/raphael.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/morris/morris.min.js') !!}"></script>
    <script src="{!! asset('assets/js/plugins/morris/morris-data.js') !!}"></script>
    
    <script>

//        sub-menu selection active
            if(window.location.href.indexOf("/doctor/schedule") != -1){
                $('#scheduleMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/doctor/settings/chamber") != -1){
                $('#chamberSubMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/doctor/settings/education") != -1){
                $('#educationSubMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/doctor/settings/personal-info") != -1){
                $('#personalInfoSubMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/doctor/settings/specialties") != -1){
                $('#specialtySubMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/doctor/settings/work-history") != -1){
                $('#workHistoryPersonalSubMenuItem').addClass('activeMenuItem');
            }else{
                $('#dashboardMenuItem').addClass('activeMenuItem');
            }
        
//        Sub-menu hold collapse
            if(window.location.href.indexOf("/doctor/settings/") != -1){               
                document.getElementById("settingCollapseMenuItemLI").classList.remove("collapsed");
                document.getElementById("settingCollapseMenuItemLI").classList.add("active");
                document.getElementById("settingCollapseMenuItemLI").setAttribute('aria-expanded', 'true');
                
                document.getElementById("submenu-collapse").classList.remove("sub-menu");
                document.getElementById("submenu-collapse").classList.add("in");
                document.getElementById("submenu-collapse").setAttribute("aria-expanded", "true");
                document.getElementById("submenu-collapse").setAttribute("style", "");              
            }
    </script>
</body>

</html>