<?php

if(!isset($_SESSION) )session_start();
require_once("../vendor/autoload.php");
use App\Db;
$db = new Db();
use App\Doctor;
$auth= new Doctor($db);

use App\Patient;
$patient=new Patient($db);
use App\Admin;
$adminObj=new Admin($db);


if($_SESSION['role_status']==0){
$status= $auth->log_out();

session_destroy();
session_start();
$_SESSION['message']="Successfully logout";
header("Location: ../login.php");
}
else if($_SESSION['role_status']==2){
$status= $patient->log_out();

session_destroy();
session_start();
$_SESSION['message']="Successfully logout";
header("Location: ../login.php");
}
else if($_SESSION['role_status']==3){
$status= $adminObj->log_out();

session_destroy();
session_start();
$_SESSION['message']="Successfully logout";
header("Location: ../login.php");
}


