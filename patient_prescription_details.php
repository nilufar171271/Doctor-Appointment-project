<?php
session_start();
include_once "templateLayout.php";
include_once "vendor/autoload.php";
use App\Db;
$db = new Db();

use App\Patient;
use App\Doctor;
use App\Prescription;
use App\Prescript_medicine_details;
use App\Prescript_test_details;
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


$prescript_id=$_GET['id'];



$obj=new Prescription($db);
$pdata=$obj->singleRowData($prescript_id);
$timestamp = strtotime($pdata->date);

$doc_id=$pdata->doctor_id;
$objectDoctor=new Doctor($db);
$docdata=$objectDoctor->singleRowData($doc_id);

$mobj=new Prescript_medicine_details($db);
$mdata=$mobj->showall($prescript_id);

$tobj=new Prescript_test_details($db);
$tdata=$tobj->showall($prescript_id);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Online Doctor Appointment Systems</title>
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!--<link href="../resources/css/bootstrap.min.css" rel="stylesheet" />-->
    <link href="resources/css/bootstrap.css" rel="stylesheet" />
    <link href="resources/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="resources/css/flexslider.css" rel="stylesheet" />
    <link href="resources/css/prettyPhoto.css" rel="stylesheet" />
    <link href="resources/css/camera.css" rel="stylesheet" />
    <link href="resources/css/jquery.bxslider.css" rel="stylesheet" />
    <link href="resources/css/style.css" rel="stylesheet" />
    <link href="resources/css/datepicker.css" rel="stylesheet" />

    <!-- Theme skin -->
    <link href="resources/color/default.css" rel="stylesheet" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="resources/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="resources/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="resources/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="resources/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="resources/ico/favicon.png" />
    <link href="resources/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="resources/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
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
            <div class="span12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="content">
                                <div style="width: 70%;margin: 0 auto">
                                    <br>
                                    <button type="button" onclick="printReceipt()" class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i>Print Prescription</button>
                                </div>

                                <div style="border:2px black solid; background: white;width: 70%;margin: 0 auto" id="myCanvas">
                                    <div>
                                        <br>
                                        <h3 style="text-align: center;"><?php echo $docdata->full_name; ?></h3>
                                        <h6 style="text-align: center;"><?php echo $docdata->qualification; ?></h6>
                                        <h6 style="text-align: center;">Mobile: <?php echo $docdata->mobile; ?></h6>
                                    </div>

                                    <hr>

                                    <div style="width: 100%;overflow: hidden;">
                                        <div style="width: 95%;margin: 0 auto;">
                                            <div style="width: 50%;float: left;overflow: hidden;">
                                                <p><strong>Prescription No:</strong> <?php echo $prescript_id; ?></p>
                                            </div>
                                            <div style="width: 50%;float: right;overflow: hidden;">
                                                <p style="text-align: right;"><strong>Date:</strong> <?php echo date('d-m-Y', $timestamp); ?></p>
                                            </div>
                                        </div>

                                        <div style="width: 95%;margin: 0 auto;">
                                            <div style="width: 100%;overflow: hidden;">
                                                <p><strong>Patient Name:</strong><?php echo $pdata->full_name; ?></p>
                                            </div>
                                            <div style="width: 33%;float: left;overflow: hidden;">
                                                <p style="text-align: center;"><strong>Age:</strong> <?php echo $pdata->age; ?></p>
                                            </div>
                                            <div style="display: inline-block;margin:0 auto;width:33%;overflow: hidden;">
                                                <p style="text-align: center;"><strong>Gender:</strong> <?php echo $pdata->gender; ?></p>
                                            </div>
                                            <div style="width: 33%;float: right;overflow: hidden;">
                                                <p style="text-align: center;"><strong>Mobile:</strong> <?php echo $pdata->mobile; ?></p>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="min-height: 600px;width:100%;margin-top: 50px;overflow: hidden;">
                                        <div style="width: 35%;float: left;overflow: hidden;height: 600px">
                                            <div style="width: 80%;margin:0 auto;overflow: hidden;">
                                                <h6>Problem Description </h6>
                                                <p><?php echo $pdata->plm_descript; ?></p>
                                                <h6>Note </h6>
                                                <p><?php echo $pdata->note; ?></p>
                                                <hr>
                                                <h6>Lab Test </h6>
                                                <?php

                                                foreach ($tdata as $value) { ?>
                                                    <div class="test">
                                                        <p># <strong><?php echo $value->test_name; ?></strong></p>
                                                        <p><?php echo $value->description; ?></p>
                                                        <hr>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div style="width: 65%;height: 600px;float: right;overflow: hidden;">

                                            <div style="width: 80%;margin:0 auto;overflow: hidden;">
                                                <h6>Medicine </h6>
                                                <?php

                                                foreach ($mdata as $value) { ?>
                                                    <div class="medicine">
                                                        <p># <strong><?php echo $value->med_name; ?></strong></p>
                                                        <p><?php echo $value->med_taking_time; ?></p>
                                                        <p><?php echo $value->med_taking_dura; ?></p>
                                                    </div>
                                                    <hr/>
                                                <?php } ?>
                                            </div>






                                        </div>
                                    </div>
                                    <div style="width: 100%;overflow: hidden;">
                                        <div style="width: 100%;overflow: hidden;background: #45327b">
                                            <p style="color: #fff;text-align: center;font-size: 12px">Footer Info. | Consult Time: <?php echo $docdata->practice_time_start; ?> to <?php echo $docdata->practice_time_stop; ?>, Serial Time <?php echo $docdata->serial_time_start; ?> to <?php echo $docdata->serial_time_stop; ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
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
script();
?>
<script>
    function printReceipt()
    {
        var receipt = window.open('','','width=1176,height=1176');
        receipt.document.open("text/html");
        receipt.document.write(document.getElementById('myCanvas').innerHTML);
        receipt.document.close();
        receipt.print();
    }
</script>
</body>

</html>
