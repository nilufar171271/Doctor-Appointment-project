<?php
	session_start();
	include_once "../vendor/autoload.php";
	
	use App\Patient;
	use App\Doctor;
	use App\Labarotorian;
	use App\Admin;
	use App\Db;
	$db = new Db();
	
	if($_POST['status']==0){



		$adminObj=new Admin($db);
		$adminObj->preparedata($_POST);
		$authenticate=$adminObj->loginCheck();
		if($authenticate){
			$_SESSION['role_status']=3;
			$_SESSION['email']=$_POST['email'];
			header("Location:../admin/index.php");
			
		}
		else{
			$_SESSION['message']="Email & password doesn't match!";
			//header("Location:../views/login.php");
		}
	}
	else if($_POST['status']==1){
		$doctObj=new Doctor($db);
		$doctObj->preparedata($_POST);
		$approved=$doctObj->approveOrNot();
		if($approved){
            $authenticate=$doctObj->loginCheck();
            if($authenticate){
                $_SESSION['role_status']=0;
                $_SESSION['email']=$_POST['email'];
                header("Location:../doctor/index.php");
            }
            else{
                $_SESSION['message']="Email & password doesn't match!";
                header("Location:../login.php");
            }
        }
        else{
            $_SESSION['message']="Yor account is not approved yet!";
            header("Location:../login.php");
        }


	}

	else if($_POST['status']==3){
		$object=new Patient($db);
		$object->preparedata($_POST);
		$authenticate=$object->loginCheck();
		if($authenticate){
			$_SESSION['role_status']=2;
			$_SESSION['email']=$_POST['email'];
			header("Location:../index.php");
		}
		else{
			$_SESSION['message']="Email & password doesn't match!";
			header("Location:../login.php");
		}
	}
?>