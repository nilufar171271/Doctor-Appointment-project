<?php
session_start();
include_once "../vendor/autoload.php";
use App\Labarotorian;
$object=new Labarotorian();
$object->preparedata($_POST)->update();
$_SESSION['message']="Profile Updated Successfully!";
header("Location:../views/laboratorian/profile.php");
