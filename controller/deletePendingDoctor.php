<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
$object=new Doctor($db);
$object->destroy($_GET['id']);
$_SESSION['message']="Data has been Deleted";
header("Location:../admin/pending_doctor_request.php");