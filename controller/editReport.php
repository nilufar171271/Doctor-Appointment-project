<?php
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Prescript_test_details;
$object=new Prescript_test_details($db);
if(isset($_FILES['reportfile']['name']) && !empty($_FILES['reportfile']['name'])){

        $picName=time().$_FILES['reportfile']['name'];
        $tmp_name=$_FILES['reportfile']['tmp_name'];
        move_uploaded_file($tmp_name,'../resources/lab_reports/'.$picName);
        $_POST['picture_name']=$picName;
        $object->preparedata($_POST);
		$object->updateReportLab();
 		header("Location: ../views/laboratorian/editReport.php?id=".$_POST['id']);
}
else{
		$object->preparedata($_POST);
		$object->updateReportLabWithoutFile();
 		header("Location: ../views/laboratorian/editReport.php?id=".$_POST['id']);
}

