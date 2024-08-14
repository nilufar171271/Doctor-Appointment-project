<?php

namespace App;
use App\Database;
use PDO;

class Prescription
{

    public $id;
    public $patient_id;
    public $doctor_id;
    public $sl_no;
    public $note;
    public $age;
    public $plm_descript;
   

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
            $this->doctor_id= $data['doctor_id'];
        }
        if (array_key_exists('sl_no', $data)) {
            $this->sl_no= $data['sl_no'];
        }
        if (array_key_exists('note', $data)) {
            $this->note = $data['note'];
        }
        if (array_key_exists('age', $data)) {
            $this->age= $data['age'];
        }
        if (array_key_exists('plm_descript', $data)) {
            $this->plm_descript= $data['plm_descript'];
        }
        
        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `prescription`(`patient_id`, `doctor_id`, `sl_no`, `age`, `plm_descript`, `note`) VALUES (?,?,?,?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->patient_id);
        $STH->bindParam(2, $this->doctor_id);
        $STH->bindParam(3, $this->sl_no);
        $STH->bindParam(4, $this->age);
        $STH->bindParam(5, $this->plm_descript);
        $STH->bindParam(6, $this->note); 
        $STH->execute();
        $last_id=$this->DBH->lastInsertId();
        return $last_id;
    }

    public function show(){
        $sql="SELECT * FROM `prescription`";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showView($id){

        /*$sql="SELECT appointment.*,doctor.full_name as doctor_name,doctor.qualification,
        specialist_lookup.specialist,doctor.mobile,doctor.practice_time_start as start,
        doctor.practice_time_stop as stop FROM `appointment`,doctor,specialist_lookup 
        WHERE appointment.doctor_id=doctor.id AND doctor.specialist_id=specialist_lookup.specialist_id 
        AND appointment.patient_id=$this->patient_id AND appointment.status=1 AND 
        appointment.seen_status=1 ORDER BY appointment.date ASC";*/
        


        $sql="SELECT prescription.*,
        patient.full_name,
        patient.age,
        patient.mobile,
        patient.gender
        FROM prescription, patient 
        where prescription.doctor_id=$id
        AND patient.id=prescription.patient_id";

        $data=$this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function ViewForPatient($id){
        $sql="SELECT prescription.*,
        doctor.full_name as dctor_name,
        doctor.mobile as doctor_mobile
        FROM prescription, doctor
        where prescription.patient_id=$id 
        AND prescription.doctor_id=doctor.id 
        ORDER BY id DESC";
        $data=$this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }



    public function singleRowData($id)
    {
        $sql = "SELECT prescription.*, patient.full_name, patient.gender, patient.mobile FROM `prescription` LEFT JOIN patient ON patient.id = prescription.patient_id where prescription.id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `prescription` SET `sl_no`=?,`age`=? ,`plm_descript`=?,`note`=? WHERE `id`=$this->$id";

        $STH = $this->DBH->prepare($query);
        $STH->bindParam(1, $this->sl_no);
        $STH->bindParam(2, $this->age);
        $STH->bindParam(3, $this->plm_descript);
        $STH->bindParam(4, $this->note); 
        $STH->execute();

    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `prescription` WHERE id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }
    public function numofRecord($patient_id)
    {
        $sql = "SELECT COUNT(id) AS total FROM `prescription` WHERE `patient_id`=$patient_id";
        $data = $this->DBH->prepare($sql);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function numofRecordforDoc($doctor_id)
    {
        $sql = "SELECT COUNT(id) AS total FROM `prescription` WHERE `doctor_id`=$doctor_id";
        $data = $this->DBH->prepare($sql);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
}