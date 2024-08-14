<?php
session_start();
require_once "templateLayout.php";
include_once "vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;

$doc= new Doctor($db);
$mdoc = $doc->singleRowData($_GET['id']);
date_default_timezone_set('Asia/Dhaka');
$current_time=date("H:i");
$serial_start_time=date("H:i",strtotime($mdoc->	serial_time_start));
$serial_stop_time=date("H:i",strtotime($mdoc->	serial_time_stop));


if($current_time >=$serial_start_time and $current_time <= $serial_stop_time){
    $serial_time_status=true;
}
else{
    $serial_time_status=false;
}

$serial_time_status=true;
$relatedDoctors=$doc->getDoctorBySpeciality($mdoc->specialist_id);
$date = date('Y-m-d');
$newDate=date('Y-m-d',strtotime("+7 day", strtotime($date)));

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

    <section id="inner-headline">
        <div class="container">
            <div class="span12">
                <div class="inner-heading">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a> <i class="icon-angle-right"></i></li>
                        <li>Doctor <i class="icon-angle-right"></i></li>
                        <li class="active"><h6><?php echo $mdoc->full_name?></h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span8">
                    <!--doctor detail-->
                    <h3><?php echo $mdoc->full_name?></h3>
                    <hr>
                    <div class="row">
                        <div class="span3">
                            <figure>
                                <a class="swipebox" href="resources/img/doctor_photo/<?php echo $mdoc->photo?>" title="<?php echo $mdoc->full_name?>">
                                    <img src="resources/img/doctor_photo/<?php echo $mdoc->photo?>" alt="<?php echo $mdoc->full_name?>" style="height: 200px;" width="100%">
                                </a>
                                <hr>
                                <h5 class="text-center"><?php echo $mdoc->full_name?></h5>

                            </figure>
                        </div>
                        <div class="span5">
                            <div class="entry-content">
                                <h5>Contact Number – <?php echo $mdoc->mobile?></h5>
                                <h5>Email - <?php echo $mdoc->email?></h5>
                                <div class="doc-schedule clearfix">
                                    <p><strong>Speciality - </strong><span><?php echo $mdoc->specialist_title?></span></p><p><strong>Education - </strong><span>MBBS, Cardiology</span></p><p><strong>Work Time - </strong><span><?php echo $mdoc->practice_time_start?> To <?php echo $mdoc->practice_time_stop?> </span></p>
                                    <p><strong>Serial Time - </strong><span><?php echo $mdoc->serial_time_start?> To <?php echo $mdoc->serial_time_stop?> </span></p>
                                    <p><strong>Chamber - </strong><span><?php echo $mdoc->nid?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="appoint-section clearfix contactForm">

                        <?php
                        if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])){
							
							

                            if ($serial_time_status==true){
                                ?>

                                <form  action="controller/addAppointment.php" method="post" id="inSerialTime">

                                    <h3>Take Appointment</h3>
                                    <hr>
                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <div class="thumbnail">
                                                <h6 style="text-align: center;">Consult Fee: <span style="color: red"><?php echo $mdoc->consult_fee?></span></h6>
                                                <!--<h5 style="text-align: center;">BKash Merchant Number</h5>
                                                <h4 style="text-align: center;color: red"><?php echo $mdoc->bkash_merchant_no?>-->
                                                <h4> <img src="resources/img/Bkash-logo.png"> </h4>       

                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="const_amount" value="<?php echo $mdoc->consult_fee?>" readonly>

                                    <em><h5 style="color: red;text-align: center"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></h5></em>
                                    <div class="row col-md-12">
                                        <div class="col-md-12">
                                            <input type="text" name="a_date" id="datepicker" class="required" placeholder="Appointment Date"  title="* Please provide appointment date" autocomplete="off" required>
                                        </div>
                                        <div class="col-md-12">
                                            <textarea name="message" id="app-message" class="required"  rows="5" placeholder="Message" title="* Please provide your message" required></textarea>
                                        </div>
<!--                                         <div class="col-md-12">
                                            <input type="text" name="transaction_id"  class="required" placeholder="Provide your bkash transaction ID"  title="*your bkash transaction number" autocomplete="off" required>
                                        </div> -->
                                    </div>
                                    <input type="hidden" name="patient_id" value="<?php echo $_SESSION['patient_id']?>" readonly>
                                    <input type="hidden" name="doctor_id" value="<?php echo $_GET['id']?>" readonly>
                                    <input type="hidden" name="newDate" value="<?php echo $newDate?>" readonly>



                                    <div class="row" align="center">
                                        <div class="col-md-12">
                                            <input type="submit" name="Submit" class="btn btn-primary" value="Submit Request"/>
                                        </div>
                                        <div class="col-md-12">
                                            <div id="response-container"></div>
                                            <div id="error-container"></div>
                                        </div>
                                    </div>
                                </form>

                                <?php

                            }
                            else{
                                echo "<div class=\"alert alert-danger\" id=\"notInSerialTime\">
                                            <strong>Try again Later!</strong> Taking Appointment Time is Over.
                                        </div>";

                            }}
                        else{
                            ?>

                            <a href='login.php' class='btn btn-primary'>Take Appointment</a>
                            <?php
                        }
                        ?>


                    </div>
                </div>
                <div class="span12">
                    <div class="row">
                        <section id="team">
                            <br>
                            <h5>Related Doctors</h5>
                            <hr>
                            <ul id="thumbs" class="team">
                                <?php foreach ($relatedDoctors as $value){

                                    if ($value->id==$_GET['id'])
                                        continue;
                                    ?>
                                    <!-- Item Project and Filter Name -->
                                    <li class="item-thumbs span4 target" data-id="id-0">
                                        <div class="team-box thumbnail">
                                            <img src="resources/img/doctor_photo/<?php echo $value->photo;?>" alt="" style="height: 200px"/>
                                            <div class="caption">
                                                <h6 style="font-size: 16px"><?php echo $value->full_name?></h6>
                                                <p><strong>Speciality - </strong><span><?php echo $mdoc->specialist_title?></span></p><p><strong>Education - </strong><span>MBBS, Cardiology</span></p><p><strong>Work Time - </strong><span><?php echo $value->practice_time_start?> To <?php echo $value->practice_time_stop?> </span></p>
                                                <p><strong>Serial Time - </strong><span><?php echo $value->serial_time_start?> To <?php echo $value->serial_time_stop?> </span></p>
                                                <ul class="social-network">
                                                    <a class="read-more" href="doctor_details.php?id=<?php echo $value->id?>" style='width: 50%;background-color: #396681'> Details</a>
                                                    <a class="read-more" href="doctor_details.php?id=<?php echo $value->id?>" style='width: 50%;background-color: #10146b'> Appointment</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End Item Project -->
                                    <?php
                                }
                                ?>
                            </ul>
                        </section>

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

