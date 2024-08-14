<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Patient;
$object=new Patient($db);
$object->preparedata($_POST);
$object->update();
$_SESSION['message']="Profile has been updated!";
header("Location:../profile.php");
   
