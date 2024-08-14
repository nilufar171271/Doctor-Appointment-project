<?php
use App\Appointment;
use App\Db;
use App\Prescription;
function css(){
    ?>
    <meta charset="utf-8">
    <title>Online Doctor Appointment System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!--<link href="resources/css/bootstrap.min.css" rel="stylesheet" />-->
    <link href="resources/css/bootstrap.css" rel="stylesheet" />
    <link href="resources/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="resources/css/flexslider.css" rel="stylesheet" />
    <link href="resources/css/prettyPhoto.css" rel="stylesheet" />
    <link href="resources/css/camera.css" rel="stylesheet" />
    <link href="resources/css/jquery.bxslider.css" rel="stylesheet" />
    <link href="resources/css/style.css" rel="stylesheet" />
    <link href="resources/css/datepicker.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
<?php
}
function adminDoctorCss(){
    ?>
    <meta charset="utf-8">
    <title>Online Doctor Appointment Systems</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!--<link href="../resources/css/bootstrap.min.css" rel="stylesheet" />-->
    <link href="../resources/css/bootstrap.css" rel="stylesheet" />
    <link href="../resources/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="../resources/css/flexslider.css" rel="stylesheet" />
    <link href="../resources/css/prettyPhoto.css" rel="stylesheet" />
    <link href="../resources/css/camera.css" rel="stylesheet" />
    <link href="../resources/css/jquery.bxslider.css" rel="stylesheet" />
    <link href="../resources/css/style.css" rel="stylesheet" />
    <link href="../resources/css/datepicker.css" rel="stylesheet" />

    <!-- Theme skin -->
    <link href="../resources/color/default.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../resources/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../resources/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../resources/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="../resources/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="shortcut icon" href="../resources/ico/favicon.png" />
    <link href="../resources/css/dataTables.bootstrap.min.css" rel="stylesheet" />
    <link href="../resources/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
            $(".selectmenu").find("option").eq(0).remove();
        } );
    </script>
<?php
}
function navigation(){
    $db = new Db();
    $doc = new Appointment($db);
    $presObj=new Prescription($db);
    if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])) {
        $mdoc = $doc->numofApproved($_SESSION['patient_id']);
        $record = $presObj->numofRecord($_SESSION['patient_id']);
        $obj= new Appointment($db);
        $obj->preparedata($_SESSION);
        $data = $obj->showApproved();
    }



    ?>
    <header>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <p class="topcontact"><i class="icon-phone"></i> +88 01814 000 000</p>
                    </div>
                    <div class="span6">

                        <ul class="social-network">
                            <li><a href="#" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Linkedin"><i class="icon-linkedin icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Pinterest"><i class="icon-pinterest  icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Google +"><i class="icon-google-plus icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Dribbble"><i class="icon-dribbble icon-white"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row nomargin">
                <div class="span4">
                    <div class="logo">
                        <a href="index.php"><img src="resources/img/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="span8">
                    <div class="navbar navbar-static-top">
                        <div class="navigation">
                            <nav>
                                <ul class="nav topnav app_menu">
                                    <li class="active">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="doctor_list.php">Doctor List</a>
                                    </li>
                                    <?php
                                    if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])){
                                        ?>
                                        <li class="dropdown">
                                            <a href="">Records <?php if($record->total>0):?><span class="badge" style="background: red"><?php echo '( '.$record->total.' )'?></span><?php endif; ?> <i class="icon-angle-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <!--<li><a href="view_lab_report.php">Lab Report</a></li>-->
                                                <li><a href="patient_prescription.php">Prescription</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href="">Appointment <?php if($mdoc->total>0):?><span class="badge" style="background: red"><?php echo '( '.$mdoc->total.' )'?></span><?php endif?> <i class="icon-angle-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="pending_appointment.php">Pending Appointment</a></li>
                                                <li><a href="approved_appointment.php">Approved Appointment <span class="badge" style="background: red"><?php if($mdoc->total>0) echo $mdoc->total?></span></a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown">
                                            <a href=""><?php echo $_SESSION['email']?> <i class="icon-angle-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="profile.php">Profile</a></li>
                                                <li><a href="controller/logout.php">Logout</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <li class="dropdown">
                                            <a href="" id="access_menu">Access <i class="icon-angle-down"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="registration.php">Registration</a></li>
                                                <li><a href="login.php">Login</a></li>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                        <!-- end navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
    if(isset($_SESSION['patient_id']) && !empty($_SESSION['patient_id'])) {
        ?>
        <div class="notification" style="display: none">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-bell"></i> <?php if($mdoc->total>0):?><span class="badge" style="background: red"><?php echo $mdoc->total?></span><?php endif?>
                    <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?php
                    $serial=1;
                    if(!empty($data)){
                        foreach ($data as $oneData) {
                            $time= date("H:i:s", strtotime($oneData->start));
                          $consult_date= $oneData->date." ".$time;
                          date_default_timezone_set('Asia/Dhaka');
                          $datetime1 = new DateTime();
                          $datetime2 = new DateTime($consult_date);
                          $interval = $datetime1->diff($datetime2);
                
                          $days = $interval->format('%a days and ');
                          $hours = $interval->format('%h hours and ');
                          $minutes = $interval->format('%i');
                            if($days<=0){
                                $days= " ";
                            }
                            if($hours<=0){
                                $hours= " ";
                            }
                            if($minutes<=0){
                                $minutes= " ";
                            }

                            $remain=$days. $hours . $minutes ." minutes remaining";
                            ?>
                            <li><a href="approved_appointment.php"><strong><?php echo $oneData->doctor_name;?></strong> <br> Appointment <?php echo $remain;?></a></li>

                            <?php
                            $serial++;
                        }
                    }
                    else{
                        ?>
                        <li><a href="approved_appointment.php">No more notification.....</a></li>
                        <?php
                    }

                    ?>

                </ul>
            </div>
        </div>
        <?php
    }
    ?>
    <?php
}
function adminNavigation(){
    ?>
    <header>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <p class="topcontact"><i class="icon-phone"></i> +88 01814 000 000</p>
                    </div>
                    <div class="span6">

                        <ul class="social-network">
                            <li><a href="#" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Linkedin"><i class="icon-linkedin icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Pinterest"><i class="icon-pinterest  icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Google +"><i class="icon-google-plus icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Dribbble"><i class="icon-dribbble icon-white"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row nomargin">
                <div class="span4">
                    <div class="logo">
                        <a href="index.php"><img src="../resources/img/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="span8">
                    <div class="navbar navbar-static-top">
                        <div class="navigation">
                            <nav>
                                <ul class="nav topnav">
                                    <li class="active">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li>
                                        <a href="show_patient.php">Patient List</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="">Doctor <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="show_specialist.php">All Specialist Category</a></li>
                                            <li><a href="add_doctor.php">Add Doctor</a></li>
                                            <li><a href="show_doctor.php">Doctor List</a></li>
                                            <li><a href="pending_doctor_request.php">Pending Doctor Request</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown">
                                        <a href=""><?php echo $_SESSION['email']?> <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="profile.php">Profile</a></li>
                                            <li><a href="../controller/logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- end navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
}
function doctorNavigation(){
    $db = new Db();
    $doc = new Appointment($db);
    $presObj=new Prescription($db);
    $mdoc = $doc->pendingAppointment($_SESSION['doctor_id']);
    $record=$presObj->numofRecordforDoc($_SESSION['doctor_id']);
    ?>
    <header>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <p class="topcontact"><i class="icon-phone"></i> +88 01814 000 000</p>
                    </div>
                    <div class="span6">

                        <ul class="social-network">
                            <li><a href="#" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Linkedin"><i class="icon-linkedin icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Pinterest"><i class="icon-pinterest  icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Google +"><i class="icon-google-plus icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Dribbble"><i class="icon-dribbble icon-white"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row nomargin">
                <div class="span4">
                    <div class="logo">
                        <a href="index.php"><img src="../resources/img/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="span8">
                    <div class="navbar navbar-static-top">
                        <div class="navigation">
                            <nav>
                                <ul class="nav topnav">
                                    <li class="active">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="">Appointment <?php if($mdoc->total>0):?><span class="badge" style="background: red"><?php echo '( '.$mdoc->total.' )'?> </span> <?php endif;?> <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="pending_appointment.php">Pending Appointment <?php if($mdoc->total>0): ?><span class="badge" style="background: red"><?php echo '( '.$mdoc->total.' )'?></span><?php endif; ?></a></li>
                                            <li><a href="approved_appointment.php">Approved Appointment</a></li>
                                        </ul>
                                    </li>
                                    <li class="">
                                        <a href="show_prescription.php">Records <?php if($record->total>0): ?><span class="badge" style="background: red"><?php echo '( '.$record->total.' )'?></span><?php endif; ?></a>
                                    </li>
                                    <li class="">
                                        <a href="create_prescription.php">Prescription</a>
                                    </li>

                                    <li class="dropdown">
                                        <a href=""><?php echo $_SESSION['email']?> <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="profile.php">Profile</a></li>
                                            <li><a href="../controller/logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- end navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php
}
function script(){
    ?>
    <script src="resources/js/jquery.js"></script>
    <script src="resources/js/jquery-2.2.3.min.js"></script>
    <script src="resources/js/jquery.easing.1.3.js"></script>
    <script src="resources/js/bootstrap.js"></script>

    <script src="resources/js/modernizr.custom.js"></script>
    <script src="resources/js/toucheffects.js"></script>
    <script src="resources/js/google-code-prettify/prettify.js"></script>
    <script src="resources/js/jquery.bxslider.min.js"></script>


    <script src="resources/js/jquery.prettyPhoto.js"></script>
    <script src="resources/js/portfolio/jquery.quicksand.js"></script>
    <script src="resources/js/portfolio/setting.js"></script>
    <script src="resources/js/jquery.ui.core.min.js"></script>
    <script src="resources/js/jquery.ui.datepicker.min.js"></script>

    <script src="resources/js/jquery.flexslider.js"></script>
    <script src="resources/js/animate.js"></script>
    <script src="resources/js/inview.js"></script>
    <script src="resources/js/jquery.dataTables.min.js"></script>
    <script src="resources/js/dataTables.bootstrap.min.js"></script>
    <!-- Template Custom JavaScript File -->
    <script src="resources/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
            $(".selectmenu").find("option").eq(0).remove();
        } );
    </script>

<?php
}
function adminDoctorScript(){
    ?>
    <script src="../resources/js/jquery.js"></script>
    <script src="../resources/js/jquery-2.2.3.min.js"></script>
    <script src="../resources/js/jquery.easing.1.3.js"></script>
    <script src="../resources/js/bootstrap.js"></script>

    <script src="../resources/js/modernizr.custom.js"></script>
    <script src="../resources/js/toucheffects.js"></script>
    <script src="../resources/js/google-code-prettify/prettify.js"></script>
    <script src="../resources/js/jquery.bxslider.min.js"></script>


    <script src="../resources/js/jquery.prettyPhoto.js"></script>
    <script src="../resources/js/portfolio/jquery.quicksand.js"></script>
    <script src="../resources/js/portfolio/setting.js"></script>
    <script src="../resources/js/jquery.ui.core.min.js"></script>
    <script src="../resources/js/jquery.ui.datepicker.min.js"></script>

    <script src="../resources/js/jquery.flexslider.js"></script>
    <script src="../resources/js/animate.js"></script>
    <script src="../resources/js/inview.js"></script>
    <script src="../resources/js/jquery.dataTables.min.js"></script>
    <script src="../resources/js/dataTables.bootstrap.min.js"></script>
    <!-- Template Custom JavaScript File -->
    <script src="../resources/js/custom.js"></script>
    <script src="../resources/js/custom2.js"></script>
    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable();
            $(".selectmenu").find("option").eq(0).remove();
        } );
        

        
    </script>
<?php
}
function footer(){
    ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="span4">
                    <div class="widget">
                        <h5 class="widgetheading">Browse pages</h5>
                        <ul class="link-list">
                            <li><a href="doctor_list.php">Doctor List</a></li>
                            <li><a href="patient_prescription.php">Record</a></li>
                            <li><a href="approved_appointment.php">Appointment</a></li>
                        </ul>

                    </div>
                </div>
                <div class="span4">
                    <div class="widget">
                        <h5 class="widgetheading">Get in touch</h5>
                        <address>
                            <strong>Eterna company Inc.</strong><br>
                            Somestreet 200 VW, Suite Village A.001<br>
                            Jakarta 13426 Indonesia
                        </address>
                        <p>
                            <i class="icon-phone"></i>01826132308<br>
                            <i class="icon-envelope-alt"></i> email@domainname.com
                        </p>
                    </div>
                </div>
                <div class="span4">
                    <div class="widget">
                        <h5 class="widgetheading">Subscribe newsletter</h5>
                        <p>
                            Keep updated for new releases and freebies. Enter your e-mail and subscribe to our newsletter.
                        </p>
                        <form class="subscribe">
                            <div class="input-append">
                                <input class="span2" id="appendedInputButton" type="text">
                                <button class="btn btn-theme" type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <div class="copyright">
                            <p><span>&copy; ODAS company. All right reserved</span></p>
                        </div>

                    </div>

                    <div class="span6">
                        <div class="credits">
                            <!--
                              All the links in the footer should remain intact.
                              You can delete the links only if you purchased the pro version.
                              Licensing information: https://bootstrapmade.com/license/
                              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Eterna
                            -->
                            Designed by <a href="#/">Md. ...............</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php
}
