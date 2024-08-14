<?php
session_start();
require_once "../templateLayout.php";
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Admin;
if($_SESSION['role_status']==3){
    $auth= new Admin($db);
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

use App\Specialist;
$obj=new Specialist($db);
$mdata=$obj->show();






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
    adminNavigation();
    ?>
    <!-- end header -->

    <section id="inner-headline">
        <div class="container">
            <div class="span12">
                <div class="inner-heading">
                    <ul class="breadcrumb">
                        <li><a href="index.php">Home</a> <i class="icon-angle-right"></i></li>
                        <li>Admin <i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Add Doctor</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span2">
                </div>
                <div class="span8">
                    <h4>Add Doctor</h4>
                    <p style="color: red;text-align: center"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <form action="../controller/addDoctor.php" method="post" enctype="multipart/form-data" id="doctor_form"role="form" class="contactForm">
                        <div class="row">
                            <div class="span8 form-group field">
                                <label>Full Name</label>
                                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Chamber</label>
                                <input type="text" class="form-control" placeholder="Enter Doctor Chamber" name="nid" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Mobile</label>
                                <input type="number" class="form-control" placeholder="Mobile Number" name="mobile" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span8 form-group">
                                <label>Specialist In</label>
                                <select class="form-control" name="specialist_id">

                                    <option value="">Select a Option</option>
                                    <?php foreach ($mdata as $data){?>
                                        <option value="<?php echo $data->specialist_id?>"><?php echo $data->specialist?></option>

                                    <?php }?>
                                </select>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Practice Time Start</label>
                                <div class="row">
                                    <div class="span2 form-group">
                                        <select class="form-control" name="practice_time">
                                            <option value="12">12</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="span2 form-group">
                                        <select class="form-control" name="practice_time_status">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Practice Time End</label>
                                <div class="row">
                                    <div class="span2 form-group">
                                        <select class="form-control" name="practice_time_2">
                                            <option value="12">12</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="span2 form-group">
                                        <select class="form-control" name="practice_time_2_status">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Serial Time Start</label>
                                <div class="row">
                                    <div class="span2 form-group">
                                        <select class="form-control" name="serial_time">
                                            <option value="12">12</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="span2 form-group">
                                        <select class="form-control" name="serial_time_status">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Serial Time End</label>
                                <div class="row">
                                    <div class="span2 form-group">
                                        <select class="form-control" name="serial_time_2">
                                            <option value="12">12</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                        </select>
                                    </div>
                                    <div class="span2 form-group">
                                        <select class="form-control" name="serial_time_2_status">
                                            <option value="AM">AM</option>
                                            <option value="PM">PM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="validation"></div>
                            </div>
                            <div class="span8 form-group">
                                <label>Photo</label>
                                <input type="file" class="form-control" placeholder="Choose Picture" name="photo" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span8 form-group">
                                <label>Qualification</label>
                                <input type="text" class="form-control" placeholder="Enter Doctor Qualification" name="qualification">
                                <div class="validation"></div>

                            </div>
                            <div class="span4 form-group">
                                <label>Bkash Merchant Number</label>
                                <input type="number" class="form-control" placeholder="Enter Bkash Merchant Number" name="bkash_merchant_no" autocomplete="off" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <label>Consult Fee</label>
                                <input type="number" class="form-control" placeholder="Enter Doctor's Consult Fee. Ex- 1000" name="consult_fee" autocomplete="off" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span8 form-group">
                                <div class="text-center">
                                    <button class="btn btn-theme btn-medium margintop10" type="submit">Add Doctor</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="span2">
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

<script src="../resources/js/jquery.validate.js"></script>
<script>
	$().ready(function() {
		// validate the comment form when it is submitted
		

        $("#doctor_form").validate({
            rules: {
                bkash_merchant_no: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                },
                mobile: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                },
                
            },
            submitHandler:function(event){
                $("#doctor_form").submit()
            }
        });
		
		
	});
	</script>

</body>

</html>
