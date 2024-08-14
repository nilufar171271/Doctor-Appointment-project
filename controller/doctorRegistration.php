<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Doctor;
$objectdoctor=new Doctor($db);
echo "<pre>";
$_POST['practice_time_start']=$_POST['practice_time']." ".$_POST['practice_time_status'];
$_POST['practice_time_stop']=$_POST['practice_time_2']." ".$_POST['practice_time_2_status'];
$_POST['serial_time_start']=$_POST['serial_time']." ".$_POST['serial_time_status'];
$_POST['serial_time_stop']=$_POST['serial_time_2']." ".$_POST['serial_time_2_status'];
if(isset($_FILES['photo']['name']))
{
    $picName=time().$_FILES['photo']['name'];
    $tmp_name=$_FILES['photo']['tmp_name'];

    move_uploaded_file($tmp_name,'../resources/img/doctor_photo/'.$picName);
    $_POST['photo']=$picName;
}
/*var_dump($_POST);
die();*/
$_POST['status']=0;
if($_POST['password']==$_POST['c_password']){
    $objectdoctor->preparedata($_POST);
    $exist=$objectdoctor->exist();
    if($exist){
        $_SESSION['message']="Error! Exist User";
        header("Location:../registration.php");
    }
    else{

        $objectdoctor->preparedata($_POST)->store();
        $_SESSION['message']="Registration has been successful! please wait for approve!";
        header("Location:../login.php");
    }
}
else{
    $_SESSION['message']="Confirm Password doesn't match!";
    header("Location:../registration.php");
}

