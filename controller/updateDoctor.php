<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;

$_POST['practice_time_start']=$_POST['practice_time']." ".$_POST['practice_time_status'];
$_POST['practice_time_stop']=$_POST['practice_time_2']." ".$_POST['practice_time_2_status'];
$_POST['serial_time_start']=$_POST['serial_time']." ".$_POST['serial_time_status'];
$_POST['serial_time_stop']=$_POST['serial_time_2']." ".$_POST['serial_time_2_status'];

$objectdoctor=new Doctor($db);
$objectdoctor->preparedata($_POST)->update();
$_SESSION['message']="Your profile has been update!";
header("Location:../doctor/profile.php");
