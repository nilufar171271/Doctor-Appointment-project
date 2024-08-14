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


use App\Prescription;
$obj= new Prescription($db);
$id=$_SESSION['patient_id'];
$data = $obj->ViewForPatient($id);



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
                        <li class="active"><h6>Prescription</h6></li>
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
                        <th>Prescription No</th>
                        <th>Doctor Name</th>
                        <th>Doctor Mobile</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $serial=1;
                    foreach ($data as $oneData) {
                        ?>
                        <tr>
                            <td><?php echo $serial;?></td>
                            <td><?php echo $oneData->sl_no/**/?></td>
                            <td><?php echo $oneData->dctor_name?></td>
                            <td><?php echo $oneData->doctor_mobile?></td>
                            <td><?php echo date("d-M-Y",strtotime($oneData->date))?></td>
                            <td><a href="patient_prescription_details.php?id=<?php echo $oneData->id?>"><button class="btn-info">Details</button></a></td>
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

