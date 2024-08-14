<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Prescription;
use App\Prescript_medicine_details;
use App\Prescript_test_details;
use App\Appointment;
$appointObj=new Appointment($db);
$appointment_id=$_POST['appointment_id'];
$appointObj->consultDoctor($appointment_id);
$obj=new Prescription($db);

$_POST['doctor_id']=$_SESSION['doctor_id'];



$return_data=$obj->preparedata($_POST)->store();

$_POST['prescript_id']=$return_data;


if(!empty($_POST['med_name']) || !empty($_POST['med_taking_time']) || !empty($_POST['med_taking_time']))
{

$count= count($_POST['med_name']);
$nobj=new Prescript_medicine_details($db);

for ($i=0; $i <$count ; $i++) { 

$nobj->multistore($return_data,$_POST['med_name'][$i],$_POST['med_taking_time'][$i],$_POST['med_taking_dura'][$i]);

}

}



if(!empty($_POST['test_name']))
{

$count= count($_POST['test_name']);
$tobj=new Prescript_test_details($db);

for ($i=0; $i <$count ; $i++) { 

$tobj->multistore($return_data,$_POST['test_name'][$i],$_POST['description'][$i]);

}

}
header("Location:../doctor/show_prescription.php");

