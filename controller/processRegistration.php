<?php
	session_start();
	include_once "../vendor/autoload.php";
	use App\Db;
$db = new Db();
	use App\Patient;
	$object=new Patient($db);
	if($_POST['password']==$_POST['c_password']){
		$object->preparedata($_POST);
		$exist=$object->exist();
		if($exist){
			$_SESSION['message']="Error! Exist User";
    		header("Location:../registration.php");
		}
		else{
			$object->store();
			$_SESSION['message']="Registration has been successful! please login";
    		header("Location:../login.php");
		}
	}
	else{
		$_SESSION['message']="Confirm Password doesn't match!";
    	header("Location:../registration.php");
	}

	
?>