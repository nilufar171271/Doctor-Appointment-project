<?php
session_start();
include_once "../templateLayout.php";
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
if($_SESSION['role_status']==0){
    $auth= new Doctor($db);
    $status = $auth->preparedata($_SESSION)->logged_in();

    if(!$status) {
        $_SESSION['message']="Please LogIn first";
        header("Location:login.php");
    }
}
else {
    $_SESSION['message']="Please LogIn first";
    header("Location:login.php");
}
$data=$auth->showProfile($_SESSION['doctor_id']);


use App\Specialist;
$obj=new Specialist($db);
$mdata=$obj->show();

$words = preg_replace('/[0-9]+/','', $data->practice_time_start);
$p_start_status=trim($words);
$words2 = preg_replace('/[0-9]+/','', $data->practice_time_stop);
$p_stop_status=trim($words2);
$words3 = preg_replace('/[0-9]+/','', $data->serial_time_start);
$s_start_status=trim($words3);
$words4 = preg_replace('/[0-9]+/','', $data->serial_time_stop);
$s_stop_status=trim($words4);
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
                        <li>Doctor<i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Profile</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="span12">
                <p class="text-center" style="color: red"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                <div class="row">
                    <div class="span6">
                        <form action="../controller/updateDoctor.php" class="contactForm" method="post" >
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $data->full_name?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="Email"  value="<?php echo $data->email?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chamber</label>
                                        <input type="text" class="form-control" placeholder="Enter Chamber" value="<?php echo $data->nid?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="number" class="form-control" placeholder="Mobile Number" name="mobile" value="<?php echo $data->mobile?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <input type="text" class="form-control" placeholder="Enter Doctor Qualification" name="qualification" value="<?php echo $data->qualification?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>BKash Merchent No</label>
                                        <input type="text" class="form-control" placeholder="Enter BKash Merchant No" name="bkash_merchant_no" value="<?php echo $data->bkash_merchant_no?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Consult Fee</label>
                                        <input type="text" class="form-control" placeholder="Enter Consult Fee" name="consult_fee" value="<?php echo $data->consult_fee?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Specialist In</label>
                                        <select class="form-control" name="specialist_id">

                                            <option value="">Select a Option</option>
                                            <?php foreach ($mdata as $oneData){?>
                                                <option value="<?php echo $oneData->specialist_id?>" <?php if($data->specialist_id==$oneData->specialist_id) echo "selected";?>><?php echo $oneData->specialist?></option>

                                            <?php }?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span3 form-group">
                                    <label>Serial Time Start</label>
                                    <div class="row">
                                        <div class="span2 form-group">
                                            <select class="form-control" name="serial_time">
                                                <option value="12" <?php if(intval($data->serial_time_start)==12) echo "selected";?>>12</option>
                                                <option value="1" <?php if(intval($data->serial_time_start)==1) echo "selected";?>>1</option>
                                                <option value="2" <?php if(intval($data->serial_time_start)==2) echo "selected";?>>2</option>
                                                <option value="3" <?php if(intval($data->serial_time_start)==3) echo "selected";?>>3</option>
                                                <option value="4" <?php if(intval($data->serial_time_start)==4) echo "selected";?>>4</option>
                                                <option value="5" <?php if(intval($data->serial_time_start)==5) echo "selected";?>>5</option>
                                                <option value="6" <?php if(intval($data->serial_time_start)==6) echo "selected";?>>6</option>
                                                <option value="7" <?php if(intval($data->serial_time_start)==7) echo "selected";?>>7</option>
                                                <option value="8" <?php if(intval($data->serial_time_start)==8) echo "selected";?>>8</option>
                                                <option value="9" <?php if(intval($data->serial_time_start)==9) echo "selected";?>>9</option>
                                                <option value="10" <?php if(intval($data->serial_time_start)==10) echo "selected";?>>10</option>
                                                <option value="11" <?php if(intval($data->serial_time_start)==11) echo "selected";?>>11</option>
                                            </select>
                                        </div>
                                        <div class="span1 form-group">
                                            <select class="form-control" name="serial_time_status">
                                                <option value="AM" <?php if($s_start_status=="AM") echo "selected";?>>AM</option>
                                                <option value="PM" <?php if($s_start_status=="PM") echo "selected";?>>PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="validation"></div>
                                </div>
                                <div class="span3 form-group">
                                    <label>Serial Time End</label>
                                    <div class="row">
                                        <div class="span2 form-group">
                                            <select class="form-control" name="serial_time_2">
                                                <option value="12" <?php if(intval($data->serial_time_stop)==12) echo "selected";?>>12</option>
                                                <option value="1" <?php if(intval($data->serial_time_stop)==1) echo "selected";?>>1</option>
                                                <option value="2" <?php if(intval($data->serial_time_stop)==2) echo "selected";?>>2</option>
                                                <option value="3" <?php if(intval($data->serial_time_stop)==3) echo "selected";?>>3</option>
                                                <option value="4" <?php if(intval($data->serial_time_stop)==4) echo "selected";?>>4</option>
                                                <option value="5" <?php if(intval($data->serial_time_stop)==5) echo "selected";?>>5</option>
                                                <option value="6" <?php if(intval($data->serial_time_stop)==6) echo "selected";?>>6</option>
                                                <option value="7" <?php if(intval($data->serial_time_stop)==7) echo "selected";?>>7</option>
                                                <option value="8" <?php if(intval($data->serial_time_stop)==8) echo "selected";?>>8</option>
                                                <option value="9" <?php if(intval($data->serial_time_stop)==9) echo "selected";?>>9</option>
                                                <option value="10" <?php if(intval($data->serial_time_stop)==10) echo "selected";?>>10</option>
                                                <option value="11" <?php if(intval($data->serial_time_stop)==11) echo "selected";?>>11</option>
                                            </select>
                                        </div>
                                        <div class="span1 form-group">
                                            <select class="form-control" name="serial_time_2_status">
                                                <option value="AM" <?php if($s_stop_status=="AM") echo "selected";?>>AM</option>
                                                <option value="PM" <?php if($s_stop_status=="PM") echo "selected";?>>PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="validation"></div>
                                </div>
                                <div class="span3 form-group">
                                    <label>Practice Time Start</label>
                                    <div class="row">
                                        <div class="span2 form-group">
                                            <select class="form-control" name="practice_time">
                                                <option value="12" <?php if(intval($data->practice_time_start)==12) echo "selected";?>>12</option>
                                                <option value="1" <?php if(intval($data->practice_time_start)==1) echo "selected";?>>1</option>
                                                <option value="2" <?php if(intval($data->practice_time_start)==2) echo "selected";?>>2</option>
                                                <option value="3" <?php if(intval($data->practice_time_start)==3) echo "selected";?>>3</option>
                                                <option value="4" <?php if(intval($data->practice_time_start)==4) echo "selected";?>>4</option>
                                                <option value="5" <?php if(intval($data->practice_time_start)==5) echo "selected";?>>5</option>
                                                <option value="6" <?php if(intval($data->practice_time_start)==6) echo "selected";?>>6</option>
                                                <option value="7" <?php if(intval($data->practice_time_start)==7) echo "selected";?>>7</option>
                                                <option value="8" <?php if(intval($data->practice_time_start)==8) echo "selected";?>>8</option>
                                                <option value="9" <?php if(intval($data->practice_time_start)==9) echo "selected";?>>9</option>
                                                <option value="10" <?php if(intval($data->practice_time_start)==10) echo "selected";?>>10</option>
                                                <option value="11" <?php if(intval($data->practice_time_start)==11) echo "selected";?>>11</option>
                                            </select>
                                        </div>
                                        <div class="span1 form-group">
                                            <select class="form-control" name="practice_time_status">
                                                <option value="AM" <?php if($p_start_status=="AM") echo "selected";?>>AM</option>
                                                <option value="PM" <?php if($p_start_status=="PM") echo "selected";?>>PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="validation"></div>
                                </div>
                                <div class="span3 form-group">
                                    <label>Practice Time End</label>
                                    <div class="row">
                                        <div class="span2 form-group">
                                            <select class="form-control" name="practice_time_2">
                                                <option value="12" <?php if(intval($data->practice_time_stop)==12) echo "selected";?>>12</option>
                                                <option value="1" <?php if(intval($data->practice_time_stop)==1) echo "selected";?>>1</option>
                                                <option value="2" <?php if(intval($data->practice_time_stop)==2) echo "selected";?>>2</option>
                                                <option value="3" <?php if(intval($data->practice_time_stop)==3) echo "selected";?>>3</option>
                                                <option value="4" <?php if(intval($data->practice_time_stop)==4) echo "selected";?>>4</option>
                                                <option value="5" <?php if(intval($data->practice_time_stop)==5) echo "selected";?>>5</option>
                                                <option value="6" <?php if(intval($data->practice_time_stop)==6) echo "selected";?>>6</option>
                                                <option value="7" <?php if(intval($data->practice_time_stop)==7) echo "selected";?>>7</option>
                                                <option value="8" <?php if(intval($data->practice_time_stop)==8) echo "selected";?>>8</option>
                                                <option value="9" <?php if(intval($data->practice_time_stop)==9) echo "selected";?>>9</option>
                                                <option value="10" <?php if(intval($data->practice_time_stop)==10) echo "selected";?>>10</option>
                                                <option value="11" <?php if(intval($data->practice_time_stop)==11) echo "selected";?>>11</option>
                                            </select>
                                        </div>
                                        <div class="span1 form-group">
                                            <select class="form-control" name="practice_time_2_status">
                                                <option value="AM" <?php if($p_stop_status=="AM") echo "selected";?>>AM</option>
                                                <option value="PM" <?php if($p_stop_status=="PM") echo "selected";?>>PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="validation"></div>
                                </div>

                            </div>


                            <input type="hidden" name="id" value="<?php echo $data->id?>" readonly>
                            <button type="submit" class="btn btn-info btn-fill">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                    <div class="span1">

                    </div>
                    <div class="span4">
                        <h5 class="text-center">Change Password</h5>
                        <form action="../controller/updateDoctorPass.php" class="contactForm" method="post" >
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" class="form-control" placeholder="New Password" name="password" minlength="6" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="Confirm password" name="c_password" minlength="6" required>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="id" value="<?php echo $data->id?>" readonly>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Change Password</button>
                        <div class="clearfix"></div>
                        </form>
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

