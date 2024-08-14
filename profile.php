<?php
session_start();
include_once "templateLayout.php";
include_once "vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Patient;
if($_SESSION['role_status']==2){
    $auth= new Patient($db);
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
$id=$_SESSION['patient_id'];
$data = $auth->ViewProfile($id);
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
                        <li class="active"><h6>Profile</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <p class="text-center" style="color: red"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                <div class="span6">
                    <form class="contact-form contactForm" action="controller/updateProfile.php" method="post" >
                        <input type="text" name="full_name" class="required" placeholder="Enter your full name" value="<?php echo $data->full_name?>">
                        <input type="number" name="age" class="required" placeholder="Enter your Age" value="<?php echo $data->age?>">
                        <select name="gender" class="required" required>
                            <option value="Male" <?php if($data->gender=='Male') echo "selected";?>>Male</option>
                            <option value="Female" <?php if($data->gender=='Female') echo "selected";?>>Female</option>
                            <option value="Undefined" <?php if($data->gender=='Undefined') echo "selected";?>>Undefined</option>
                        </select>
                        <textarea name="address" class="required" placeholder="Enter your Address" required><?php echo $data->address?></textarea>
                        <input type="number" name="mobile" class="required" placeholder="Enter your Contact No" value="<?php echo $data->mobile?>" readonly>
                        <input type="email" name="email"  placeholder="Enter your Email" value="<?php echo $data->email?>" disabled >

                        <input type="number" class="required" placeholder="Enter your National ID No" value="<?php echo $data->nid?>" readonly>
                        <input type="hidden" name="id" value="<?php echo $data->id?>" readonly>
                        <input  class="btn btn-primary" type="submit" value="Update Profile">

                    </form>
                </div>
                <div class="span6">
                    <form  class="contact-form contactForm" action="controller/changePatientPassword.php" method="post">
                        <input type="password" class="required" minlength="6" name="password" placeholder="New password" required>
                        <input type="password" class="required" minlength="6" name="c_password" placeholder="Confirm password" required>
                        <input type="hidden" name="id" value="<?php echo $data->id?>" readonly>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Change Password</button>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Change Password</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure to change your password?</p>
                                        <input type="submit" class="btn btn-info" value="Yes">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

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
script();
?>

</body>

</html>

