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
use App\Prescription;
$object=new Prescription($db);
$id=$_SESSION['doctor_id'];
$alldata=$object->showView($id);


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
                        <li class="active"><h6>Show Prescription</h6></li>
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
                            <th width="8%">Prescription ID</th>
                            <th width="10%">Date</th>
                            <th width="15%">Patient Name</th>
                            <th width="5%">Age</th>
                            <th width="6%">Gender</th>
                            <th width="10%">Mobile</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($alldata as $item){

                            $timestamp = strtotime($item->date);


                            ?>
                            <tr>
                                <td><?php echo $item->id?></td>
                                <td><?php echo date('d-m-Y', $timestamp); ?></td>
                                <td><?php echo $item->full_name?></td>
                                <td><?php echo $item->age?></td>

                                <td><?php echo $item->gender?></td>
                                <td><?php echo $item->mobile?></td>
                                <td ><a href="view_prescription.php?pid=<?php echo $item->id; ?>" target="_blank"><button type="button" class="btn btn-primary">View</button></a>
                                    <!--<a href="lab_report_from_doctor.php?pid=<?php /*echo $item->id; */?>" target="_blank"><button type="button" class="btn btn-primary">Report</button></a>--></td>
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
