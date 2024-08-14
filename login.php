<?php
session_start();
require_once "vendor/autoload.php";
require_once "templateLayout.php";
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
                        <li>Contact <i class="icon-angle-right"></i></li>
                        <li class="active"><h6>Login</h6></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container">
            <div class="row">
                <div class="span4">
                </div>
                <div class="span4">
                    <h4>Login</h4>
                    <p style="color: red;text-align: center"><?php if(isset($_SESSION['message'])){ echo $_SESSION['message']; $_SESSION['message']=" ";}?></p>
                    <form action="controller/loginProcess.php" method="post" role="form" class="contactForm">
                        <div class="row">
                            <div class="span4 form-group field">
                                <select name="status">
                                    <option value="3">Patient</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Doctor</option>
                                </select>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <input type="email" name="email" class="required email" placeholder="Enter your email" title="* Please provide a valid email address" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <input type="password" name="password" class="required" placeholder="Enter your password" title="* Please provide a valid email address" required>
                                <div class="validation"></div>
                            </div>
                            <div class="span4 form-group">
                                <div class="text-center">
                                    <button class="btn btn-theme btn-medium margintop10" type="submit">Login</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="span4">
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

</body>

</html>
