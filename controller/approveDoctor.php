<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
$object=new Doctor($db);
$object->preparedata($_POST);
$object->approveDoctor();
$_SESSION['message']="Doctor Has Been Approved!";
header("Location:../admin/pending_doctor_request.php");