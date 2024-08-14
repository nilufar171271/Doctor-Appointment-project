<?php
	session_start();
	include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
    use App\Patient;
    $object=new Patient($db);
    $object->destroy($_GET['del']);
    $_SESSION['message']="Data has been Deleted";
    header("Location: ../views/admin/showPatient.php");

?>