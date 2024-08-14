<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
$objectdoctor=new Doctor($db);
if($_POST['password']==$_POST['c_password']){
    $objectdoctor->preparedata($_POST)->updatePassword();
    $_SESSION['message']="Your password has been changed!";
    header("Location:logout.php");

}
else{
    $_SESSION['message']="Confirm Password doesn't match!";
    header("Location:../doctor/profile.php");
}

