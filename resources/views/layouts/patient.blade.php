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

    <!-- Custom CSS --->
    <link href="{{ asset('assets/css/zakiStyle.css') }}" rel="stylesheet">

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
    <?php                                   //Check if user is patient or die!
        if(Auth::user()->userType !== 2){
            print("<h1 style='background-color: white; color: red;'>");
            exit("Illegal attempt to access unauthorized page!! Please go back to the login page to login.");
            print("</h1>");
    }

    $url = $_SERVER['REQUEST_URI'];         //Get Current URL for menu selection

    ?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top"  style="background-color: black">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="www.mydoctorbd.com">MyDoctorBD.com</a>
            </div>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav"  style="background-color: black">
                    @if (Auth::guest())
                        <a href="#"><i class="fa fa-user"></i> Unknown User</a>

                    @else
                    <!-- notifications menu item -->
                    <li class="">
                      <a href="patient/notifications" class="" data-toggle="" role="button" area-expanded><span class="fa fa-bell"> </span> Notificatios <span class="badge">{{ count(Auth::user()->unreadNotifications)}}</span>
                      </a>

                    <!-- user menu item -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"> </i> {{ ucfirst(Auth::user()->first_name) }} {{ ucfirst(Auth::user()->last_name) }} <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li>
                              <a href="{!! url('/patient/account') !!}"><i class="fa fa-fw fa-wrench"></i> My Account</a>
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
                      </li>
                    @endif

                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
              @auth
                <ul class="nav navbar-nav side-nav">
                    <li id="dashboardMenuItem">
                        <a href="{!! url('/patient') !!}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                    <li id="searchMenuItem">
                        <a href="{!! url('/patient/search') !!}"><i class="glyphicon glyphicon-search"></i> Find Doctor</a>
                    </li>

                    <li id="appointmentMenuItem">
                        <a href="{!! url('/patient/myappointments') !!}"><i class="glyphicon glyphicon-list"></i> My Appointments</a>
                    </li>


                    <!--Settings Menu Item-->
                   <li id = "settingCollapseMenuItemLI" class="collapsed" data-toggle="collapse" data-target="#submenu-collapse" aria-expanded='false'>

                     <a href="#"><i class="fa fa-fw fa-wrench"></i> Settings  <span class="caret" style="transform: rotate(-90deg);"></span></a>
                     <ul id="submenu-collapse" name="settingCollapseMenuItemUL" class="sub-menu collapse"  aria-expanded='false' style="height: 0px;">

                         <!--personal-info Sub-Menu Item-->
                         <li class="" id="personalInfoSubMenuItem">
                             <a href="{{ url('/patient/settings/personal-info') }}"><i class="glyphicon glyphicon-user"></i> Personal Info</a>
                         </li>
                     </ul>
                    </li>
              @endauth
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">
          <!--// All the Contents goes here-->
          @auth
			      @yield('content')
          @endauth
        </div>
        <!-- /#page-wrapper -->

    </div>

    <!-- in page scripts -->
    @yield('jscriptPatient')

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
            if(window.location.href.indexOf("/patient/search") != -1){
                $('#searchMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/patient/myappointments") != -1){
                $('#appointmentMenuItem').addClass('activeMenuItem');
            }else if(window.location.href.indexOf("/patient/settings/personal-info") != -1){
                $('#personalInfoSubMenuItem').addClass('activeMenuItem');
            }else{
                $('#dashboardMenuItem').addClass('activeMenuItem');
            }

//        Sub-menu hold collapse
            if(window.location.href.indexOf("/patient/settings/") != -1){
              let settingMenuItem = document.getElementById("settingCollapseMenuItemLI");
              let submenuCollapse = document.getElementById("submenu-collapse");

                settingMenuItem.classList.remove("collapsed");
                settingMenuItem.classList.add("active");
                settingMenuItem.setAttribute('aria-expanded', 'true');

                submenuCollapse.classList.remove("sub-menu");
                submenuCollapse.classList.add("in");
                submenuCollapse.setAttribute("aria-expanded", "true");
                submenuCollapse.setAttribute("style", "");
            }
    </script>
</body>

</html>
