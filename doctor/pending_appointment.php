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
use App\Appointment;
$object=new Appointment($db);
$object->preparedata($_SESSION);
$allData=$object->showforDoctorPendingAppointment();
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
                        <li class="active"><h6>Pending Appointment</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span12 table-responsive">
                    <p class="text-center" style="color: red"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                        <tr>
                            <th width="6%">Serial</th>
                            <th width="6%">Appointment Date</th>
                            <th width="8%">Patient Name</th>
                            <th width="10%">Age</th>
                            <th width="15%">Contact</th>
                            <th width="5%">Message</th>
                            <th width="10%">Transaction ID</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $serial=1;
                        foreach ($allData as $item){
                            ?>
                            <tr>
                                <td><?php echo $serial?></td>
                                <td><?php echo date("d-M-Y",strtotime($item->date))?></td>
                                <td><?php echo $item->patient_name?></td>
                                <td><?php echo $item->patient_age ?></td>
                                <td><?php echo $item->patient_contact?></td>
                                <td><?php echo $item->message?></td>
                                <td><?php echo $item->transaction_id?></td>
                                <td><a href="../controller/approveAppointment.php?id=<?php echo $item->id?>"><button type="button" class="btn btn-primary">Approve</button></a></td>
                            </tr>
                            <?php
                            $serial++;
                        }?>
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
