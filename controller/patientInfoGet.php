<?php
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Patient;
$objectdoctor=new Patient($db);
$id=$_POST['id'];
$mdata=$objectdoctor->singleRowData($id);
echo json_encode($mdata);


