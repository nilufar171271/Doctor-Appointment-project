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
/*use App\Patient;
$obj=new Patient();
$mdata=$obj->show();*/
use App\Appointment;
$object=new Appointment($db);
$mdata=$object->showforPrescription($_SESSION['doctor_id']);
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

    <section id="inner-headline">
        <div class="container">
            <div class="span12">
                <div class="inner-heading">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a> <i class="icon-angle-right"></i></li>
                        <li>Doctor <i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Create Prescription</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <p class="text-center" style="color: red"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <form action="../controller/prescriptionProcess.php" method="post" class="contactForm">

                        <div class="content">

                            <div class="row">

                                <div class="span3">
                                    <div class="form-group">
                                        <label>SL NO</label>
                                        <input type="number" class="form-control custom-control" placeholder="Serial No" name="sl_no" value="<?php echo time()?>" readonly="">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="span4">
                                    <div class="form-group">
                                        <label>Patient</label>

                                        <select name="patient_id" id="patient_id" class="form-control custom-control" required>

                                            <option value="">Select a patient</option>

                                            <?php foreach ($mdata as $value) { ?>

                                                <option value="<?php echo $value->patient_id ?>" data-appointment="<?php echo $value->id?>"><?php echo $value->full_name ?></option>

                                            <?php } ?>

                                        </select>


                                    </div>
                                </div>

                                <div class="span2">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text" class="form-control custom-control reset" placeholder="Age" name="age" id="age" readonly>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Gender</label>
                                        <input type="text" class="form-control custom-control reset" placeholder="Gender" name="gender" id="gender" readonly>
                                    </div>
                                </div>
                                <div class="span3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mobile</label>
                                        <input type="text" class="form-control custom-control reset" placeholder="Mobile" name="mobile" id="mobile" readonly>
                                    </div>
                                </div>


                                <div class="span6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Problem Description</label>

                                        <textarea class="form-control" cols="12" name="plm_descript" required></textarea>

                                    </div>
                                </div>
                                <div class="span6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Note</label>

                                        <textarea class="form-control" cols="12" name="note"></textarea>

                                    </div>
                                </div>
                            </div>

                        </div>









                        <div class="row">
                            <div class="span12">
                                <button type="button" class="btn btn-primary btn-fill add_new add_new_medicine">Add New Medicine</button>
                            </div>
                            <div class="span5">

                                <label>Medicine Name</label>
                                <input type="text" name="med_name[]" class="form-control custom-control" placeholder="Medicine Name" required>

                            </div>
                            <div class="span3">

                                <label>Taking Time</label>

                                <input type="text" name="med_taking_time[]" class="form-control custom-control" placeholder="Time" required>

                            </div>
                            <div class="span3">

                                <label for="exampleInputEmail1">Duration</label>
                                <input type="text" name="med_taking_dura[]" class="form-control custom-control" placeholder="Duration" required>

                            </div>



                        </div>

                        <div class="add_place add_medicine_place">
                        </div>


                        <hr/>

                        <div class="row">
                            <div class="span12">
                                <button type="button" class="btn btn-primary btn-fill add_new add_new_test">Add New Test</button>
                            </div>
                            <div class="span4">

                                <label>Test Name</label>
                                <input type="text" name="test_name[]" class="form-control custom-control" placeholder="Test Name" >

                            </div>
                            <div class="span7">

                                <label>Description</label>

                                <input type="text" name="description[]" class="form-control custom-control" placeholder="Description" >

                            </div>

                        </div>

                        <div class="add_place add_test_place">
                        </div>


                        <hr/>
                        <div class="row button_row">
                            <div class="span12">
                                <input type="hidden" name="appointment_id" id="appointment_id" readonly>
                                <button type="submit" class="btn btn-info btn-fill submit-button">Submit</button>
                            </div>

                        </div>

                    </form>
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
