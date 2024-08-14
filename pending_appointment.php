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


use App\Appointment;

$obj= new Appointment($db);
$obj->preparedata($_SESSION);
$data = $obj->showPending();



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
                        <li class="active"><h6>Pending Appointment</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="span12 table-responsive">
                <table class="table table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Appointment Date</th>
                        <th>Doctor</th>
                        <th>Qualification</th>
                        <th>Specialist</th>
                        <th>Contact</th>
                        <th>Duration</th>
                        <th>Transaction ID</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $serial=1;
                    foreach ($data as $oneData) {
                        ?>
                        <tr>
                            <td><?php echo $serial;?></td>
                            <td><?php echo date("d-M-Y",strtotime($oneData->date))?></td>
                            <td><?php echo $oneData->doctor_name?></td>
                            <td><?php echo $oneData->qualification?></td>
                            <td><?php echo $oneData->specialist?></td>
                            <td><?php echo $oneData->mobile?></td>
                            <td><?php echo $oneData->start." to ".$oneData->stop?></td>
                            <td><?php echo $oneData->transaction_id?></td>
                            <td><i class="fa fa-times-circle-o fa-lg" aria-hidden="true" style="color: #dc2828;"></i> Pending</td>
                        </tr>
                        <?php
                        $serial++;
                    }
                    ?>

                    </tbody>
                </table>
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

