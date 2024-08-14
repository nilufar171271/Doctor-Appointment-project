<?php
error_reporting(-1); // reports all errors
ini_set("display_errors", "1"); // shows all errors
ini_set("log_errors", 1);

session_start();
require_once "templateLayout.php";
include_once "vendor/autoload.php";

use App\Db;
use App\Doctor;
use App\Specialist;

$db = new Db();
$doc = new Doctor($db);
$mdoc = $doc->show();


 $objSpecialist=new Specialist($db);
 $allSpeciality=$objSpecialist->show();

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
                        <li><a href="#">Pages</a> <i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Doctor List</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span12">
                    <div class="row">
                        <div class="span4">
                            <h4>Meet our <span>Medical Specialists</span></h4>
                            <div class="form-group">
                                <select class="selectpicker form-control" id="selectVal" onchange="findByCategory()">
                                    <option value="">Select Category</option>
                                    <?php foreach ($allSpeciality as $item){?>
                                        <option value="<?php echo $item->specialist?>"><?php echo $item->specialist?></option>
                                    <?php }?>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="row">
                        <section id="team">
                            <ul id="thumbs" class="team">
                                <?php foreach ($mdoc as $value) {
                                    ?>
                                    <!-- Item Project and Filter Name -->
                                    <li class="item-thumbs span3 target" data-id="id-0">
                                        <div class="team-box thumbnail">
                                            <img src="resources/img/doctor_photo/<?php echo $value->photo;?>" alt="" style="height: 200px"/>
                                            <div class="caption">
                                                <h6 style="font-size: 16px"><?php echo $value->full_name?></h6>
                                                <p>
                                                    <?php echo $value->specialist_title; ?>
                                                </p>
                                                <ul class="social-network">
                                                    <a class="read-more" href="doctor_details.php?id=<?php echo $value->id?>" style='width: 50%;background-color: #396681'> Details</a>
                                                    <a class="read-more" href="doctor_details.php?id=<?php echo $value->id?>" style='width: 50%;background-color: #10146b'> Appointment</a>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- End Item Project -->
                                    <?php
                                }
                                ?>
                            </ul>
                        </section>

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
    function findByCategory() {
        var e = document.getElementById("selectVal");
        var selected = e.options[e.selectedIndex].value;
        var filter=selected.toLowerCase();
        if (selected == ""){
            document.location.reload();
        }
        else {
            var nodes = document.getElementsByClassName('target');

            for (i = 0; i < nodes.length; i++) {
                if (nodes[i].innerText.toLowerCase().includes(filter)) {
                    nodes[i].style.display = "block";
                } else {
                    nodes[i].style.display = "none";
                }
            }

        }

    }
</script>
</body>

</html>
