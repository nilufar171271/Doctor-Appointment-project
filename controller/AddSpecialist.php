<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Specialist;
$object=new Specialist($db);
$object->preparedata($_POST);
$object->store();
$_SESSION['message']="Date has been Inserted!";
header("Location:../admin/show_specialist.php");

   
