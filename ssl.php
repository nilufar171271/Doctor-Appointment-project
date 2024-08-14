<?php

session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Appointment;
$object=new Appointment($db);
$_POST['id']=$_GET['id'];

$_POST['transaction_id']=random_string(uniqid());
$object->preparedata($_POST);



var_dump($_POST);


function random_string($length) {

    $d=date ("d");
    $m=date ("m");
    $y=date ("Y");
    $t=time();
    $dmt=$d+$m+$y+$t;
    $ran= rand(0,19210100);
    $dmtran= $dmt+$ran+$dmt;


    $key = 'tnx-';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key. $dmtran ;
}


$object->approvedPayment();
header("Location:../pending_appointment.php");


