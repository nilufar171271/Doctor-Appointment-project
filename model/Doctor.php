<?php

namespace App;
use PDO;

class Doctor

{
    
    public $id;
    public $full_name;
    public $email;
    public $password;
    public $nid;
    public $mobile;
    public $specialist_id;
    public $practice_time_start;
    public $practice_time_stop;
    public $serial_time_start;
    public $serial_time_stop;
    public $status;
    public $photo;
    public $qualification;
    public $bkash_merchant_no;
    public $consult_fee;
    private $DBH;


    
    
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
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('password', $data)) {
            $this->password = md5($data['password']);
        }
        if (array_key_exists('nid', $data)) {
            $this->nid = $data['nid'];
        }

        if (array_key_exists('mobile', $data)) {
            $this->mobile = $data['mobile'];
        }
        if (array_key_exists('specialist_id', $data)) {
            $this->specialist_id = $data['specialist_id'];
        }

        if (array_key_exists('practice_time_start', $data)) {
            $this->practice_time_start = $data['practice_time_start'];
        }
        if (array_key_exists('practice_time_stop', $data)) {
            $this->practice_time_stop = $data['practice_time_stop'];
        }

        if (array_key_exists('serial_time_start', $data)) {
            $this->serial_time_start = $data['serial_time_start'];
        }
        if (array_key_exists('serial_time_stop', $data)) {
            $this->serial_time_stop = $data['serial_time_stop'];
        }

        if (array_key_exists('status', $data)) {
            $this->status = $data['status'];
        }
        if (array_key_exists('photo', $data)) {
            $this->photo = $data['photo'];
        }

        if (array_key_exists('qualification', $data)) {
            $this->qualification = $data['qualification'];
        }
        if (array_key_exists('bkash_merchant_no', $data)) {
            $this->bkash_merchant_no = $data['bkash_merchant_no'];
        }
        if (array_key_exists('consult_fee', $data)) {
            $this->consult_fee = $data['consult_fee'];
        }


        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `doctor`(`full_name`, `email`, `password`, `nid`, `mobile`, `specialist_id`, `practice_time_start`, `practice_time_stop`, `serial_time_start`, `serial_time_stop`,`photo`,`qualification`,`status`,`bkash_merchant_no`,`consult_fee`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->full_name);
        $STH->bindParam(2, $this->email);
        $STH->bindParam(3, $this->password);
        $STH->bindParam(4, $this->nid);
        $STH->bindParam(5, $this->mobile);
        $STH->bindParam(6, $this->specialist_id);
        $STH->bindParam(7, $this->practice_time_start);
        $STH->bindParam(8, $this->practice_time_stop);
        $STH->bindParam(9, $this->serial_time_start);
        $STH->bindParam(10, $this->serial_time_stop);
        $STH->bindParam(11, $this->photo);
        $STH->bindParam(12, $this->qualification);
        $STH->bindParam(13, $this->status);
        $STH->bindParam(14, $this->bkash_merchant_no);
        $STH->bindParam(15, $this->consult_fee);
        $STH->execute();
    }

    public function update()
    {
        $query ="UPDATE `doctor` SET `full_name`=?,`mobile`=?,`qualification`=?,`specialist_id`=?,`practice_time_start`=?,`practice_time_stop`=?,`serial_time_start`=?,`serial_time_stop`=?,`bkash_merchant_no`=?,`consult_fee`=? WHERE `id`='$this->id'";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->full_name);
        $STH->bindParam(2, $this->mobile);
        $STH->bindParam(3, $this->qualification);
        $STH->bindParam(4, $this->specialist_id);
        $STH->bindParam(5, $this->practice_time_start);
        $STH->bindParam(6, $this->practice_time_stop);
        $STH->bindParam(7, $this->serial_time_start);
        $STH->bindParam(8, $this->serial_time_stop);
        $STH->bindParam(9, $this->bkash_merchant_no);
        $STH->bindParam(10, $this->consult_fee);
        $STH->execute();
    }
    public function approveDoctor()
    {
		
        $query ="UPDATE `doctor` SET `status`=1 WHERE `id`='$this->id'";
        $STH=$this->DBH->prepare($query);
        //$STH->bindParam(1, $this->status);
        $STH->execute();
    }
    public function updatePassword()
    {
        $query ="UPDATE `doctor` SET `password`=? WHERE `id`='$this->id'";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->password);
        $STH->execute();
    }
    public function ViewProfile($id){
        $sql="SELECT * FROM `doctor` WHERE id=$id";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);
        return $alldata;
    }
    public function exist(){
        $query = "SELECT * FROM `doctor` WHERE `email`='$this->email' OR `mobile`='$this->mobile'";
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
    public function show(){
        

        $sql="SELECT a.*,b.specialist as specialist_title FROM `doctor` a,specialist_lookup b WHERE a.`specialist_id`=b.specialist_id AND a.`status`=1";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showPending(){
        $sql="SELECT a.*,b.specialist as specialist_title FROM `doctor` a,specialist_lookup b WHERE a.`specialist_id`=b.specialist_id AND a.`status`=0";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showProfile($id){
        $sql="SELECT * FROM doctor WHERE id=$id";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);

        return $alldata;
    }

    public function singleRowData($id)
    {
        $sql = "SELECT a.*,b.specialist as specialist_title FROM `doctor` a,specialist_lookup b WHERE a.`specialist_id`=b.specialist_id and a.id=?";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function getDoctorBySpeciality($id)
    {
        $sql = "SELECT * FROM `doctor` WHERE `specialist_id`=?";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $DoctorsData = $data->fetchAll(PDO::FETCH_OBJ);
        return $DoctorsData;
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `doctor` WHERE `id`=?";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }


    public function loginCheck(){
        $query = "SELECT * FROM `doctor` WHERE `email`='$this->email' AND `password`='$this->password' AND `status`=1";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();

        $sql = "SELECT * FROM `doctor` WHERE `email`='$this->email' AND `password`='$this->password' AND `status`=1";
        $STH2=$this->DBH->query($sql);
        $STH2->setFetchMode(PDO::FETCH_OBJ);
        $doctorData=$STH2->fetch();
        $_SESSION['doctor_id']=$doctorData->id;

        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function approveOrNot(){
        $query = "SELECT * FROM `doctor` WHERE `email`='$this->email' AND `password`='$this->password' AND `status`=1";
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
    public function todayPatients($id)
    {
        $sql = "SELECT count(id) AS total FROM `appointment` WHERE `doctor_id`=$id AND `status`=1 AND `date`=CURDATE()";
        $data = $this->DBH->prepare($sql);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }

}