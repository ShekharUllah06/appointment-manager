    @extends('layouts.front')

    @section('content')
        <div class="wrapper bgded overlay" style="background-image: url('assets/images/banner01.png')">
          <div id="pageintro" class="hoc clear">
            <!-- ################################################################################################ -->
            <article>
              <div>
                  <!--Delete this h1 after site completion-->
                  <h1 style="background-color: red; font-weight: bolder; color: yellow;">This site is Still Under-Construction, Please re-visit site later. You are also Welcome to test this site and leave us a comment via our E-Mail:
                                                                                            <a href="mailto:zaki.hashim.chow@gmail.com?Subject=mydoctorbd%20Visitor">
                                                                                                info@mydoctorbd.com</a>.</h1>


                <p class="heading">Find Your Doctor</p>
                <h2 class="heading">Book an Appointment</h2>
                <p>A platform for <i style='color: lightgreen; font-weight: bolder;'>Doctors</i> to manage schedules and Appointments. And for <i style='color: lightgreen; font-weight: bolder;'>Patients</i> to Book an Appointment. It is <i style='color: red; font-weight: bolder;'>Free!</i></p>
              </div>
              <footer>
                <ul class="nospace inline pushright">
                    <li>
                        <a href="{{ url('/doctor_profile', ["doctorID" => '1', "calanderMonth" => '2018-02-21']) }}" class="btn btn-primary"><i class="glyphicon glyphicon-search"> </i> Find Doctor</a>
                    </li>
                    <li>
                        <a href="{{ url('/register') }}" class="btn btn-danger"><i class="glyphicon glyphicon-user"> </i> Register </a>
                    </li>
                </ul>
              </footer>
            </article>
            <!-- ################################################################################################ -->
          </div>
        </div>



        <!-- ################################################################################################ -->
        <div id='intro' class="wrapper row2">
            <main class="hoc container clear">
                <h1 class="font-x3 center">Whom is it For?</h1>
                <ul class="nospace group services">
                <!-- ################################################################################################ -->
                    <li class="one_half first btmspace-10">
                        <article>
                            <h2 class="heading font-x1 center">Doctor</h2>
                            <p>
                               Want to get rid of that extra secretary that you have to pay for and you
                               think you should not? Or just want to centrally control and/or organize
                               different portions of your work system more efficiently.  Doctors can now
                               Display your Work, Educational and Chamber Informations, manage Schedules
                               and Appointments and allow your patients to get your appointments. Be Organized,
                               Be efficient and Cut your costs. It is easy and <a href="{{ url('/register') }}">Free</a>.
                            </p>
                        </article>
                    </li>
                    <li class="one_half btmspace-10">
                        <article>
                            <h1 class="heading font-x1 center">Patient</h1>
                            <p>
                                Sometimes finding an appropriate doctor for in your location, or Getting an
                                appointment of your Doctor can be very hard. But using
                                <a href="www.mydoctorbd.com">MyDoctorBD.com</a> you can now find your desired
                                doctor and get an appointment very easily with few clicks only. Patients can
                                now search for desired Doctors according to Specialty and Location, View Doctor
                                Profile/Details and make an appointment as per your requirements all
                                <a href="{{ url('/register') }}">Free</a>.
                            </p>
                        </article>
                    </li>
                </ul>
            <!-- ################################################################################################ -->
          </main>
        </div>

        <!-- ################################################################################################ -->
        <div id="howItWork" class="wrapper bgded overlay" style="background-image: url('assets/images/sectionBanner02.jpg')">
            <main class="hoc container clear">
                <h1 class="font-x3">How it Works?</h1>
                <ul class="nospace group services">
                    <li class="one_half first btmspace-10">
                        <article>
                            <h2 class="heading font-x1">Un-Registered</h2>
                            <ol>
                                <li> Click "<a href="{{ url('/doctor_profile', ["doctorID" => '1', "calanderMonth" => '2018-02-21']) }}">Find Doctor</a>" button. </li>
                                <li> Filter/Find your Doctor and Click on your desired Doctor. </li>
                                <li> Check for Doctors Schedule Dates on left side Calender and Click Get Appointment. </li>
                                <li> Input your Basic Information and submit. </li>
                                <li> Get conformation and Serial Number. </li>
                            </ol>
                        </article>
                    </li>
                    <li class="one_half btmspace-10">
                        <article>
                            <h4 class="heading font-x1">Registered</h4>
                            <ol>
                                <li> First <a href="{{ url('/register') }}">Register</a>. </li>
                                <li> Click "Browse/Filter Doctor" left panel Menu Item at user panel. </li>
                                <li> Filter/Find your Doctor and Click on your desired Doctor. </li>
                                <li> Check for Doctors Schedule Dates on left side Calender and Click Get Appointment. </li>
                                <li> Get conformation and Serial Number. </li>
                            </ol>
                        </article>
                    </li>
                </ul>
            </main>
        </div>

        <!-- ################################################################################################ -->
        <div id="about" class="wrapper row3">
            <article class="hoc container clear center">
                <h1 class="font-x3">About</h1>
                <p class="btmspace-30">
                    <a href="www.mydoctorbd.com">MyDoctorBD.com</a> is a Free Scheduling and Appointment
                    management application for Doctors and Patients developed by
                    <a href="https://www.linkedin.com/in/miah-abdullah-shekhar-3baa8826/">Shekhar Ullah</a> and
                    <a href="https://www.linkedin.com/in/zakihashemchowdhury/">Zaki Hashem Chowdhury</a> based in Bangladesh.
                </p>
            </article>>
        </div>


    @endsection
