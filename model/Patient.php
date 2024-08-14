<?php

namespace App;
use App\Database;
use PDO;

class Patient 
{

    public $id;
    public $full_name;
    public $age;
    public $gender;
    public $mobile;
    public $email;
    public $address;
    public $nid;
    public $password;
    public function __construct(PDO $pdo)
    {
        $this->DBH = $pdo;
    }
    public function preparedata($data)
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('full_name', $data)) {
            $this->full_name = $data['full_name'];
        }
        if (array_key_exists('age', $data)) {
            $this->age= $data['age'];
        }
        if (array_key_exists('gender', $data)) {
            $this->gender= $data['gender'];
        }

        if (array_key_exists('mobile', $data)) {
            $this->mobile= $data['mobile'];
        }
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('address', $data)) {
            $this->address = $data['address'];
        }
        if (array_key_exists('nid', $data)) {
            $this->nid = $data['nid'];
        }

        if (array_key_exists('password', $data)) {
            $this->password = md5($data['password']);
        }
        
        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `patient` (`full_name`, `age`, `gender`, `mobile`, `email`, `address`, `nid`, `password`) VALUES (?,?,?,?,?,?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->full_name);
        $STH->bindParam(2, $this->age);
        $STH->bindParam(3, $this->gender);
        $STH->bindParam(4, $this->mobile);
        $STH->bindParam(5, $this->email);
        $STH->bindParam(6, $this->address);
        $STH->bindParam(7, $this->nid);
        $STH->bindParam(8, $this->password);
        
        $STH->execute();
    }

    public function show(){
        $sql="SELECT * FROM `patient`";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }

    public function ViewProfile($id){
        $sql="SELECT * FROM `patient` WHERE id=$id";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);
        return $alldata;
    }
    public function total_patient(){
        $sql="SELECT COUNT(id) AS total FROM `patient`";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);

        return $alldata;
    }

    public function total_doctor(){
        $sql="SELECT COUNT(id) AS total FROM `doctor`";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);

        return $alldata;
    }

    public function total_appointment(){
        $sql="SELECT COUNT(id) as total FROM `appointment` ";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function singleRowData($id)
    {
        $sql = "SELECT * FROM `patient` where id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `patient` SET `full_name`=?,`age`=?,`gender`=?,`mobile`=?,`address`=? WHERE `id`=$this->id";

        $STH = $this->DBH->prepare($query);

        $STH->bindParam(1,$this->full_name);
        $STH->bindParam(2,$this->age);
        $STH->bindParam(3,$this->gender);
        $STH->bindParam(4,$this->mobile);
        $STH->bindParam(5,$this->address);

        $STH->execute();

    }

    public function changePassword()
    {
        $query ="UPDATE `patient` SET `password`=? WHERE `id`=$this->id";
        $STH =$this->DBH->prepare($query);
        $STH->bindParam(1,$this->password);
        $STH->execute();
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `patient` WHERE id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }
    public function exist(){
        $query = "SELECT * FROM `patient` WHERE `email`='$this->email' OR `mobile`='$this->mobile' OR `nid`=$this->nid";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();


        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function existContact(){
        $query = "SELECT * FROM `patient` WHERE `mobile`='$this->mobile'";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();

        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function loginCheck(){
        $query = "SELECT * FROM `patient` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();

        $sql = "SELECT * FROM `patient` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH2=$this->DBH->query($sql);
        $STH2->setFetchMode(PDO::FETCH_OBJ);
        $patientData=$STH2->fetch();
        $_SESSION['patient_id']=$patientData->id;

        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function logged_in(){
        if ((array_key_exists('email', $_SESSION)) && (!empty($_SESSION['email']))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function log_out(){
        $_SESSION['email']="";
        return TRUE;
    }
}