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

use App\Patient;
$objectPatient=new Patient($db);
$alldata=$objectPatient->show();
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
                        <li class="active"><h6>Show Patient</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span12 table-responsive">
                    <table class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Email</th>
                            <th>Mobile Nu.</th>
                            <th>Gender</th>
                            <th>Address</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($alldata as $item){?>
                            <tr>
                                <td><?php echo $item->full_name?></td>
                                <td><?php echo $item->age?></td>
                                <td><?php echo $item->email?></td>
                                <td><?php echo $item->mobile?></td>
                                <td><?php echo $item->gender?></td>
                                <td><?php echo $item->address?></td>
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
