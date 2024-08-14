<?php
include_once "../vendor/autoload.php";
use App\Labarotorian;
if(isset($_FILES['photo']['name']))
{
    $picName=time().$_FILES['photo']['name'];
    $tmp_name=$_FILES['photo']['tmp_name'];

    move_uploaded_file($tmp_name,'../resources/labrotorian_photo/'.$picName);
    $_POST['photo']=$picName;
}
$object=new Labarotorian();
$object->preparedata($_POST)->store();
header("Location:../views/admin/showLabrotorian.php");
