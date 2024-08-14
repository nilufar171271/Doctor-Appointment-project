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
$object=new Specialist($db);
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
                        <li class="active"><h6>Show Specialist</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">

<a href="addSpecialist.php"><button class="btn btn-theme btn-medium margintop10" type="submit">Add Specialist</button></a>


                <div class="span12 table-responsive">
                    <p style="color: red;text-align: center"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <table class="table table-striped table-bordered dataTable">
                        <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th width="35%">Specialist Name</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=1; foreach ($alldata as $item){?>
                            <tr>
                                
                                 <td><?php echo $i++; ?></td>  
                                <td><?php echo $item->specialist?></td>
                                <td><a href="editSpecialist.php?id=<?php echo $item->specialist_id?>"><button type="button" class="btn btn-primary">Edit</button></a></td>
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
