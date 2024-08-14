<?php
session_start();
include_once "../vendor/autoload.php";
use App\Db;
$db = new Db();
use App\Appointment;
$object=new Appointment($db);
$_POST['date']=date("Y-m-d",strtotime($_POST['a_date']));
$_POST['transaction_id']="";
$object->preparedata($_POST);
$status=$object->is_appoint();

if(!$status){
    if($_POST['date']<$_POST['newDate']){
        $returnID=$object->store();

        //header("Location:../pending_appointment.php");

    $paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    $paypalID = 'fahim.arifen@gmail.com';
    $form = "<form id='paypal' action='". $paypalURL."' method='post'>";
    $form .='<input type="hidden" name="business" value="'. $paypalID.'">';
    $form .='<input type="hidden" name="cmd" value="_xclick">';
    $itemDetail = "Doctor consultant free";
    $orderId = $returnID;
    $totalAmountWithFee = $_POST['const_amount'];
    $form .='<input type="hidden" name="item_name" value=" '.$itemDetail.'">
        <input type="hidden" name="item_number" value="'.$orderId.'">
        <input type="hidden" name="amount" value="'.$totalAmountWithFee.'">
        <input type="hidden" name="currency_code" value="USD">';

    $form .="<input type='hidden' name='cancel_return' value='http://localhost/appointment/pending_appointment.php'>
    <input type='hidden' name='return' value='http://localhost/appointment/controller/updateAppointment.php?id=".$returnID."'>";
    $form.="<script type=\"text/javascript\"> document.forms['paypal'].submit();</script>";
    echo $form;




    }
    else{
        $_SESSION['message']="You can't take appointment for more than 7 days from today";
        header("Location:../doctor_details.php?id=".$_POST['doctor_id']);
    }
}
else{
    $_SESSION['message']="You are already appointed to this doctor for today and not consult yet!";
    header("Location:../doctor_details.php?id=".$_POST['doctor_id']);
}
