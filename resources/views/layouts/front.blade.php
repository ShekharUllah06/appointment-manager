<!DOCTYPE html>
<!--
Main Site/Application Information

Public pages Template Information

Application Name: Doctor Appointment Manager
Application Author: Zaki Hashem Chowdhury and Shekhar Ullah

-->


<!--
Public pages Template Information

Public pages Template Name: Nodelle
Public pages Template Author: <a href="http://www.os-templates.com/">OS Templates</a>
Public pages Template Author URI: http://www.os-templates.com/
Public pages Template Licence: Free to use under our free template licence terms
Public pages Template Licence URI: http://www.os-templates.com/template-terms
-->

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'My Doctor BD Appointment Manager') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!-- Custom Fonts -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">

    
    <!-- Custom CSS --->
    <link href="{{ asset('assets/css/front.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/zakiStyle.css') }}" rel="stylesheet">
    
    <!--template related-->
    <link href="{{ asset('assets/layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">


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

<body id="top">
    
    <!--topmost bar-->
<div class="wrapper row0">
  <div id="topbar" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="fl_left">
      <ul class="nospace">
        <li><a href="#"><i class="fa fa-lg fa-home"></i></a></li>
        <li><a class="" href="{!! url('/help/faq') !!}">FAQ</a></li>
        <li><a class="" href="{!! url('/help') !!}">Help</a></li>
        <li><a href="{!! url('/login') !!}">Login</a></li>
        <li><a href="{!! url('/register') !!}">Register</a></li>
      </ul>
    </div>
    <div class="fl_right">
      <ul class="nospace">
        <li><i class="fa fa-mobile-phone"></i> +880 177 016 7057</li>
        <li><i class="fa fa-envelope-o"></i> info@mydoctorbd.com</li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </div>
</div>
    
    <!--second top bar-->
<div class="wrapper row1">
  <header id="header" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="index.html">My Doctor BD</a></h1>
      <p>Get an Appointment of your Doctor</p>
    </div>
    <!-- ################################################################################################ -->
    <nav id="mainav" class="fl_right">
      <ul class="clear">
        <li class=""><a href="{!! url('/') !!}">Home</a></li>
        <li><a class="" href="{!! url('/find') !!}">Find Doctor</a></li>
        <li><a class="" href="#intro">For Whom</a></li>
        <li><a class="" href="#howItWork">How it Works</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li style="color: red;">
            <a href="{{ url('/login') }}" class=""><i class="glyphicon glyphicon-log-in"> </i> Login</a>
        </li>

      </ul>
    </nav>
    <!-- ################################################################################################ -->
  </header>
</div>
    
    
   <!--Content Area-->
        
    @yield('content')
    
    
             
<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="title">Social Media Pages</h6>
      <p>You can contact us or get involved, get in touch or leave a comment, complain or suggestion on our social media pages.</p>
      <p class="btmspace-15">You can click any of these links at bottom to visit our social media pages.</p>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Contact Iformation</h6>
      <ul class="nospace linklist contact" id="contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          Bhatiari, Chittagong, Post Code: 4315.
          </address>
        </li>
        <li><i class="fa fa-mobile-phone"></i> +880 177 016 7057</li>
        <li><i class="fa fa-mobile-phone"></i> +880 170 864 1069</li>
        <li><i class="fa fa-envelope-o"></i> info@mydoctorbd.com</li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="title">Site Map</h6>
      <ul class="nospace linklist">
        <li><a href="http://www.mydoctorbd.com/">Home</a></li>
        <li>
            <ul>
                <li><a href="http://www.mydoctorbd.com/find/">Find Doctor</a></li>
                <li><a href="http://www.mydoctorbd.com/help/">Help</a></li>
                <li>
                    <ul>
                        <li><a href="http://www.mydoctorbd.com/help/faq/">FAQ</a></li>
                    </ul>
                </li>
                <li><a href="http://www.mydoctorbd.com/login/">Login</a></li>
                <li><a href="http://www.mydoctorbd.com/register/">Register</a></li>
            </ul>
        </li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="www.mydoctorbd.com">MyDoctorBD.com</a></p>
    <p class="fl_right">Template by <a target="_blank" href="http://www.os-templates.com/" title="Free Website Templates">OS Templates</a></p>
    <!-- ################################################################################################ -->
  </div>
</div>

<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>    







<!--Script section-->

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="{!! asset('assets/js/front.js') !!}"></script>
    
    <!--template related-->
    <script src="{{ asset('assets/layout/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/layout/scripts/jquery.backtotop.js') }}"></script>
    <script src="{{ asset('assets/layout/scripts/jquery.mobilemenu.js') }}"></script>

</body>

</html>
