<?php

namespace App;
use PDO;

class Appointment
{

    public $id;
    public $patient_id;
    public $doctor_id;
    public $date;
    public $message;
    public $status;
    public $transaction_id;

    public function __construct(PDO $pdo)
    {
        $this->DBH = $pdo;
    }
    
    public function preparedata($data)
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('patient_id', $data)) {
            $this->patient_id = $data['patient_id'];
        }
        if (array_key_exists('doctor_id', $data)) {
            $this->doctor_id = $data['doctor_id'];
        }

        if (array_key_exists('date', $data)) {
            $this->date = $data['date'];
        }
        if (array_key_exists('message', $data)) {
            $this->message = $data['message'];
        }
        if (array_key_exists('transaction_id', $data)) {
            $this->transaction_id = $data['transaction_id'];
        }

        


        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `appointment`(`patient_id`, `doctor_id`, `date`, `message`,`transaction_id`) VALUES(?,?,?,?,?)";
        $STH=$this->DBH->prepare($query);
        
        $STH->bindParam(1, $this->patient_id);
        $STH->bindParam(2, $this->doctor_id);
        $STH->bindParam(3, $this->date);
        $STH->bindParam(4, $this->message);
        $STH->bindParam(5, $this->transaction_id);
        $STH->execute();
		return $this->DBH->lastInsertId();
    }

    public function showPending(){
        $sql="SELECT appointment.*,doctor.full_name as doctor_name,doctor.qualification,specialist_lookup.specialist,doctor.mobile,doctor.practice_time_start as start,doctor.practice_time_stop as stop FROM `appointment`,doctor,specialist_lookup WHERE appointment.doctor_id=doctor.id AND doctor.specialist_id=specialist_lookup.specialist_id AND appointment.patient_id= $this->patient_id AND appointment.status=0 ORDER BY appointment.date ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showApproved(){
        $sql="SELECT appointment.*,doctor.full_name as doctor_name,doctor.qualification,specialist_lookup.specialist,doctor.mobile,doctor.practice_time_start as start,doctor.practice_time_stop as stop FROM `appointment`,doctor,specialist_lookup WHERE appointment.doctor_id=doctor.id AND doctor.specialist_id=specialist_lookup.specialist_id AND appointment.patient_id=$this->patient_id AND appointment.status=1 AND appointment.seen_status=1 ORDER BY appointment.date ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showforDoctor(){
        $sql="SELECT appointment.*,patient.full_name as patient_name,patient.age as patient_age,patient.mobile as patient_contact FROM `appointment`,patient WHERE patient.id=appointment.patient_id AND appointment.doctor_id=$this->doctor_id AND appointment.status=1 AND appointment.seen_status=1 ORDER BY appointment.date ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showforPrescription($doctor_id){
        $sql="SELECT appointment.*,patient.full_name FROM `appointment`,`patient` WHERE DATE(appointment.`date`) <= CURDATE() AND appointment.`status`=1 AND appointment.`consult_status`=0 AND appointment.`doctor_id`=$doctor_id AND patient.id=appointment.patient_id ORDER BY appointment.`date` ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showforDoctorPendingAppointment(){
        $sql="SELECT appointment.*,patient.full_name as patient_name,patient.age as patient_age,patient.mobile as patient_contact FROM `appointment`,patient WHERE patient.id=appointment.patient_id AND appointment.doctor_id=$this->doctor_id AND appointment.status=0 ORDER BY appointment.date ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showApprovedAppointment(){
        $sql="SELECT appointment.*,patient.full_name as patient_name,patient.age as patient_age,patient.mobile as patient_contact FROM `appointment`,patient WHERE patient.id=appointment.patient_id AND appointment.doctor_id=$this->doctor_id AND appointment.status=1 ORDER BY appointment.date ASC";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    
    public function singleRowData($id)
    {
        $sql = "SELECT * FROM `appointment` where id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function numofApproved($patient_id)
    {
        $sql = "SELECT count(id) as total FROM `appointment` WHERE `seen_status`=1 AND `patient_id`=$patient_id";
        $data = $this->DBH->prepare($sql);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function pendingAppointment($doctor_id)
    {
        $sql = "SELECT count(id) as total FROM `appointment` WHERE `status`=0 AND `doctor_id`=$doctor_id";
        $data = $this->DBH->prepare($sql);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `appointment` SET `patient_id`=?,`doctor_id`=?,`date`=?,`message`=?,`status`=? WHERE `id`=$this->id";

        $STH = $this->DBH->prepare($query);

        
        $STH->bindParam(1,$this->patient_id);
        $STH->bindParam(2,$this->doctor_id);
        $STH->bindParam(3,$this->date);
        $STH->bindParam(4,$this->message);
        $STH->bindParam(5,$this->status);



        $STH->execute();

    }
    public function consultDoctor($appoint_id)
    {
        $query = "UPDATE `appointment` SET `consult_status`=1,`seen_status`=2 WHERE `id`=$appoint_id";

        //echo $query;
        //return ;
        $STH = $this->DBH->prepare($query);
        $STH->execute();
        
    }
    public function approveAppointment()
    {
        $query = "UPDATE `appointment` SET `status`=1, `seen_status`=1 WHERE `id`=$this->id";
        $STH = $this->DBH->prepare($query);
        $STH->execute();

    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `appointment` WHERE id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }
	
	    public function approvedPayment()
    {
        $query = "UPDATE `appointment` SET `transaction_id`=? WHERE `id`=?";
        $STH = $this->DBH->prepare($query);
        $STH->bindParam(1,$this->transaction_id);
        $STH->bindParam(2,$this->id);
        $STH->execute();

    }
	
	
	
    public function loginCheck(){
        $query = "SELECT * FROM `labratorian` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();

        $sql = "SELECT * FROM `labratorian` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH2=$this->DBH->query($sql);
        $STH2->setFetchMode(PDO::FETCH_OBJ);
        $labData=$STH2->fetch();
        $_SESSION['labarotorian_id']=$labData->id;

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
    function is_appoint(){
        /*echo "<pre>";
        var_dump($this);
        die();*/
        $query = "SELECT * FROM `appointment` WHERE `patient_id`='$this->patient_id' AND `doctor_id`='$this->doctor_id' AND DATE(`date`)='$this->date' AND `consult_status`=0";
        //$query = "SELECT * FROM `appointment` WHERE `patient_id`='33' AND `doctor_id`='2313' AND DATE(`date`)='2019-01-02' AND `consult_status`=0";
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
}