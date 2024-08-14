<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Admin;
$object=new Admin($db);

if($_POST['password']==$_POST['c_password']){
    $object->preparedata($_POST);
    $object->changePassword();
    $_SESSION['message']="Password has been changed!";
    header("Location:logout.php");

}
else{
    $_SESSION['message']="Confirm Password doesn't match!";
    header("Location:../admin/profile.php");
}