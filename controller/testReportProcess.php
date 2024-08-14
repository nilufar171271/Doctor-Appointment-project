<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Prescription;
use App\Prescript_medicine_details;
use App\Prescript_test_details;

$i=0;
foreach($_FILES["reportfile"]["tmp_name"] as $key=>$tmp_name){
    $temp = $_FILES["reportfile"]["tmp_name"][$key];
    $name = $_FILES["reportfile"]["name"][$key];

    if(empty($temp))
    {
        break;
    }
    $picname_arr[]=time().$name;

    move_uploaded_file($temp,"../resources/lab_reports/".$picname_arr[$i]);$i++;
}
//$comma_separated = implode(",",$picname_arr);
//$_POST['picture']=$comma_separated;
 $_POST['picture_name']=implode(",", $picname_arr);
 $_POST['test_id']=implode(",", $_POST['testid']);
echo $_POST['report_details']=implode("|||}]", $_POST['reportDetails']);


$object=new Prescript_test_details($db);
$object->preparedata($_POST);
$object->Prescript_test_details();
header("Location:../views/laboratorian/viewLabtest.php");

?>
