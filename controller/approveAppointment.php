<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
	use App\Appointment;
	$object=new Appointment($db);
	$object->preparedata($_GET);
	$object->approveAppointment();
	$_SESSION['message']="Appointment Approved!";
	header("Location:../doctor/pending_appointment.php");

