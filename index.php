<?php
session_start();
require_once "vendor/autoload.php";
    require_once "templateLayout.php";

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
        css();
    ?>
</head>

<body>

<div id="wrapper">

    <!-- start header -->
   <?php
        navigation();
   ?>
    <!-- end header -->

    <!-- section featured -->
    <section id="featured">

        <!-- slideshow start here -->

        <div class="camera_wrap" id="camera-slide">

            <!-- slide 1 here -->
            <div data-src="resources/img/slides/camera/slide1/img1.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            <div class="span6">
                                <h2 class="animated fadeInDown"><strong>MyDoc <span class="colored">A Reliable Online Doctor Appointment System</span></strong></h2>
                                <p class="animated fadeInUp"> The utilization of online doctor appointment scheduler can help the organizations to streamline the workflow in a number of ways, booking individuals on a specific date prior to their scheduled appointment.</p>
                                <a href="doctor_list.php" class="btn btn-success animated fadeInUp">
                                    <i class="icon-link"></i> Doctor List
                                </a>

                            </div>
                            <div class="span6">
                                <img src="resources/img/slides/camera/slide1/R.png" alt="" class="animated bounceInDown delay1" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- slideshow end here -->

    </section>
    <!-- /section featured -->

    <section id="content">
        <div class="container">


            <div class="row">
                <div class="span12">
                    <div class="solidline"></div>
                </div>
            </div>

            <div class="row">
                <div class="span12">
                    <div class="row">
                        <div class="span12">
                            <div class="aligncenter">
                                <h3><strong>Benefits</strong></h3>
                                <p>Benefits of Online Doctor Appointment system for the doctors/patients
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="span6">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3>Benefits of <strong>Patients</strong></h3>
                                </div>
                                <div class="pricing-content">
                                    <ul>
                                        <li><i class="icon-ok"></i> Will book appointments with a tap</li>
                                        <li><i class="icon-ok"></i> Can search doctors by their speciality</li>
                                        <li><i class="icon-ok"></i> Easy to get appointment</li>
                                        <li><i class="icon-ok"></i> Can increase wellness benefits usage</li>
                                    </ul>
                                </div>
                                <div class="pricing-action">
                                    <a href="registration.php" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i> Sign Up</a>
                                </div>
                            </div>
                        </div>

                        <div class="span6">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3>Benefits of <strong>Doctors</strong></h3>
                                </div>
                                <div class="pricing-content">
                                    <ul>
                                        <li><i class="icon-ok"></i> Online Doctor scheduling services attracts more patients</li>
                                        <li><i class="icon-ok"></i> Will make sure that there are no more phone calls</li>
                                        <li><i class="icon-ok"></i> Can reduce absenteeism</li>
                                        <li><i class="icon-ok"></i> Can improve patient satisfaction</li>
                                    </ul>
                                </div>
                                <div class="pricing-action">
                                    <a href="login.php" class="btn btn-medium btn-theme"><i class="icon-chevron-down"></i> Sign In</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </section>
    <?php
        footer();
    ?>
</div>
<a href="#" class="scrollup"><i class="icon-angle-up icon-square icon-bglight icon-2x active"></i></a>

<!-- javascript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<?php
    script();
?>

</body>
</html>

