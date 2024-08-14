<?php
session_start();
include_once "../vendor/autoload.php";
use App\Labarotorian;
$objectdoctor=new Labarotorian();
if($_POST['password']==$_POST['c_password']){
    $objectdoctor->preparedata($_POST)->updatePassword();
    $_SESSION['message']="Your password has been changed!";
    header("Location:../views/laboratorian/profile.php");

}
else{
    $_SESSION['message']="Confirm Password doesn't match!";
    header("Location:../views/laboratorian/profile.php");
}

