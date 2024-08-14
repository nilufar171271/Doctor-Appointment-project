<?php
session_start();
require_once "templateLayout.php";
require_once "vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Specialist;
$obj=new Specialist($db);
$mdata=$obj->show();
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
                        <li>Contact <i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Registration</h6></li>
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
                    <h4>Register Yourself</h4>
                    <center><h6 style="color: red"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></h6></center>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#patient">Patient</a></li>
                        <li><a data-toggle="tab" href="#doctor">Doctor</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="patient" class="tab-pane fade in active">
                            <form action="controller/processRegistration.php" method="post" role="form" class="contactForm">
                                <div class="row">
                                    <div class="span8 form-group field">
									<label>Full Name</label>
                                        <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" autocomplete="off" required/>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
									<label>Age</label>
                                        <input type="number" name="age" placeholder="Enter your Age" autocomplete="off" required/>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
									<label>Gender</label>
                                        <select name="gender" autocomplete="off" required>
                                            <option value="err">-select a gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Undefined">Undefined</option>
                                        </select>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
									<label>Contact No</label>
                                        <input type="number" name="mobile" placeholder="Enter your Contact No" id="mobile" min="11"  autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
									<label>Email</label>
                                        <input type="email" name="email" placeholder="Enter your Email" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
									<label>NID</label>
                                        <input type="number" name="nid" placeholder="Enter your National ID No" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
									<label>Password</label>
                                        <input type="password" minlength="6" name="password" placeholder="Enter your password" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
									<label>Confirm Password</label>
                                        <input type="password" minlength="6" name="c_password" placeholder="Confirm password" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
									<label>Address</label>
                                        <textarea name="address" placeholder="Enter your Address" autocomplete="off" required></textarea>
                                        <div class="validation"></div>
                                        <div class="text-center">
                                            <button class="btn btn-theme btn-medium margintop10" type="submit">Register As Patient</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div id="doctor" class="tab-pane fade">
                            <form action="controller/doctorRegistration.php" method="post" enctype="multipart/form-data" role="form" class="contactForm doctor">
                                <div class="row">
                                    <div class="span8 form-group field">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="c_password" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
                                        <label>Chamber</label>
                                        <input type="text" class="form-control" placeholder="Enter Chamber" name="nid" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span4 form-group">
									<label>Contact No</label>
                                        <input type="number" name="mobile" placeholder="Enter your Contact No" id="mobile1" min="11" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
                                        <label>Specialist In</label>
                                        <select class="form-control" name="specialist_id" autocomplete="off">

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
                                                <select class="form-control" name="practice_time" autocomplete="off">
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
                                                <select class="form-control" name="practice_time_status" autocomplete="off">
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
                                                <select class="form-control" name="practice_time_2" autocomplete="off">
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
                                                <select class="form-control" name="practice_time_2_status" autocomplete="off">
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
                                                <select class="form-control" name="serial_time" autocomplete="off">
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
                                                <select class="form-control" name="serial_time_status" autocomplete="off">
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
                                                <select class="form-control" name="serial_time_2" autocomplete="off">
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
                                                <select class="form-control" name="serial_time_2_status" autocomplete="off">
                                                    <option value="AM">AM</option>
                                                    <option value="PM">PM</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
                                        <label>Photo</label>
                                        <input type="file" class="form-control" placeholder="Choose Picture" name="photo" autocomplete="off" required>
                                        <div class="validation"></div>
                                    </div>
                                    <div class="span8 form-group">
                                        <label>Qualification</label>
                                        <input type="text" class="form-control" placeholder="Enter Doctor Qualification" name="qualification" autocomplete="off">
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
                                            <button class="btn btn-theme btn-medium margintop10" type="submit">Register As Doctor</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>


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
script();
?>

<script src="resources/js/jquery.validate.js"></script>
<script>
	$.validator.setDefaults({
		submitHandler: function() {
			$(".contactForm").submit();
		}
	});

	$().ready(function() {
		// validate the comment form when it is submitted
		$(".contactForm").validate({
            rules: {
				mobile: {
                    required: true,
                    minlength: 11,
                    maxlength: 11,
                }
            }
            
        });
		
		
	});
	</script>


<!-- <script>
function isValidBDNumber(number) {
    var pattern = /^(?:\+88|01)?(?:\d{11}|\d{13})$/;
    return pattern.test(number);
}
    function numberChange(){
        var phone = document.getElementById("mobile").value;
        var phone = document.getElementById("mobile1").value;

     if(isValidBDNumber(phone)){
console.log("true");
     }else{
        console.log("Mobile No is not valid")
     }
       
    }

    </script> -->
</body>

</html>
