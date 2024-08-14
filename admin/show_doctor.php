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
use App\Doctor;
$object=new Doctor($db);
$alldata=$object->show();
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
                        <li class="active"><h6>Show Doctor</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span12 table-responsive">
                    <p style="color: red;text-align: center"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                        <tr>
                            <th width="0%">Photo</th>
                            <th width="15%">Full Name</th>
                            <th width="5%">Email</th>
                            <th width="10%">Mobile</th>
                            <th width="10%">Specialist</th>
                            <th width="10%">Practice Time</th>
                            <th width="10%">Serial Time</th>
                            <th width="10%">Qualification</th>
                            <th width="10%">Bkash No & Fee</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($alldata as $item){?>
                            <tr>
                                <td><img src="../resources/img/doctor_photo/<?php echo $item->photo?>" width="50px"></td>
                                <td><?php echo $item->full_name?></td>
                                <td><?php echo $item->email?></td>
                                <td><?php echo $item->mobile?></td>
                                <td><?php echo $item->specialist_title?></td>
                                <td><?php echo $item->practice_time_start?> to <?php echo $item->practice_time_stop?></td>
                                <td><?php echo $item->serial_time_start?> to <?php echo $item->serial_time_stop?></td>
                                <td><?php echo $item->qualification?></td>
                                <td><?php echo $item->bkash_merchant_no?> ( <?php echo $item->consult_fee?> )</td>
                                <td><a href="../controller/deleteDoctor.php?id=<?php echo $item->id?>"><button type="button" class="btn btn-primary">Delete</button></a></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
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
