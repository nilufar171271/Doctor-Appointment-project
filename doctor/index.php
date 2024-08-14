<?php
session_start();
require_once "../templateLayout.php";
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
if($_SESSION['role_status']==0){
    $auth= new Doctor($db);
    $status = $auth->preparedata($_SESSION)->logged_in();

    if(!$status) {
        $_SESSION['message']="Please LogIn first";
        header("Location: ../login.php");
    }
}
else {
    $_SESSION['message']="Please LogIn first";
    header("Location: ../login.php");
}
$data=$auth->showProfile($_SESSION['doctor_id']);
$patientData=$auth->todayPatients($_SESSION['doctor_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    adminDoctorCss();
    ?>
</head>

<body>

<div id="wrapper">

    <!-- start header -->
    <?php
    doctorNavigation();
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
                                <a href="pending_appointment.php" class="btn btn-success animated fadeInUp">
                                    <i class="icon-link"></i> Pending Appointment
                                </a>

                            </div>
                            <div class="span6">
                                <img src="../resources/img/slides/camera/slide1/R.png" alt="" class="animated bounceInDown delay1" />
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
                        <div class="span4">
                            <div class="pricing-box-wrap special animated-slow flyIn">
                                <div class="pricing-heading">
                                    <h3> <strong><?php echo $data->full_name?></strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo $data->qualification?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3>BKash <strong>Number</strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo $data->bkash_merchant_no?></h6>
                                </div>

                            </div>
                        </div>

                        <div class="span4">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3>Consult <strong>Fee</strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo $data->consult_fee?></h6>
                                </div>

                            </div>
                        </div>
                        <div class="span4">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3><strong>Date</strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo date("d-M-Y")?></h6>
                                </div>

                            </div>
                        </div>

                        <div class="span4">
                            <div class="pricing-box-wrap special animated-slow flyIn">
                                <div class="pricing-heading">
                                    <h3>Today's <strong>Total Patient</strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo $patientData->total?></h6>
                                </div>
                            </div>
                        </div>

                        <div class="span4">
                            <div class="pricing-box-wrap animated-fast flyIn">
                                <div class="pricing-heading">
                                    <h3>Today's <strong>Total Fee</strong></h3>
                                </div>
                                <div class="pricing-terms">
                                    <h6><?php echo $patientData->total*$data->consult_fee?></h6>
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
adminDoctorScript();
?>

</body>
</html>

