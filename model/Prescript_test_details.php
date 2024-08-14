<?php

namespace App;
use App\Database;
use PDO;

class Prescript_test_details
{

    public $id;
    public $prescript_id;
    public $test_name;
    public $description;
    public $picture_name;
    public $test_id;
    public $labarotorian_id;
    public $status;
    public $report_details;

   public function __construct(PDO $pdo)
    {
        $this->DBH = $pdo;
    }
    public function preparedata($data)
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if (array_key_exists('prescript_id', $data)) {
            $this->prescript_id = $data['prescript_id'];
        }
        if (array_key_exists('test_name', $data)) {
            $this->test_name= $data['test_name'];
        }
        if (array_key_exists('description', $data)) {
            $this->description= $data['description'];
        }
        if (array_key_exists('picture_name', $data)) {
            $this->picture_name= $data['picture_name'];
        }
        if (array_key_exists('test_id', $data)) {
            $this->test_id= $data['test_id'];
        }
        if (array_key_exists('labarotorian_id', $data)) {
            $this->labarotorian_id= $data['labarotorian_id'];
        }
        if (array_key_exists('report_details', $data)) {
            $this->report_details= $data['report_details'];
        }

        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `prescript_test_details`(`prescript_id`, `test_name`, `description`) VALUES (?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->prescript_id);
        $STH->bindParam(2, $this->test_name);
        $STH->bindParam(3, $this->description); 
        $STH->execute();
    }
    public function updateReportLab()
    {

        $query ="UPDATE `prescript_test_details` SET `test_report`=?,`report_details`=? WHERE `id`=$this->id";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->picture_name);
        $STH->bindParam(2, $this->report_details);
        $STH->execute();
    }
    public function updateReportLabWithoutFile()
    {

        $query ="UPDATE `prescript_test_details` SET `report_details`=? WHERE `id`=$this->id";
        $STH=$this->DBH->prepare($query);
        
        $STH->bindParam(1, $this->report_details);
        $STH->execute();
    }
    


    public function multistore($id,$test,$desc)
    {
        $query ="INSERT INTO `prescript_test_details`(`prescript_id`, `test_name`, `description`) VALUES (?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $id);
        $STH->bindParam(2, $test);
        $STH->bindParam(3, $desc);
        $STH->execute();

    }    

    public function showall($id){
        $sql="SELECT * FROM `prescript_test_details`  where prescript_id=$id";
        $data=$this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }


        public function showalltest(){
        $sql="SELECT * FROM `view_test_report`";
        $data=$this->DBH->prepare($sql);        
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function showallLabtest($id){
        $sql="SELECT prescript_test_details.*,patient.full_name AS patient,doctor.full_name AS doctor FROM `prescript_test_details`,patient,prescription,doctor WHERE prescript_test_details.status=1 AND prescript_test_details.labratorian_id=$id AND prescript_test_details.prescript_id=prescription.id AND prescription.patient_id=patient.id AND prescription.doctor_id=doctor.id ORDER BY prescript_test_details.id DESC";
        $data=$this->DBH->prepare($sql);        
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    

    public function showallAssignedtest(){
        $sql="SELECT * FROM `view_test_report`";
        $data=$this->DBH->prepare($sql);        
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }


    public function singleRowData($id)
    {
        $sql = "SELECT * FROM `prescript_test_details` where id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `prescript_test_details` SET `test_name`=?,`description`=? WHERE `id`=$this->$id";

        $STH = $this->DBH->prepare($query);
        $STH->bindParam(1, $this->test_name);
        $STH->bindParam(2, $this->description); 
        $STH->execute();

    }
   
    
    public function prescript_test_details()
    {
        $this->status=1;
        $pic=explode(",", $this->picture_name);
        $test_id=explode(",",  $this->test_id);
        $report_details=explode("|||}]",  $this->report_details);
        
        $count=0;

        foreach ($pic as $key) {
            $query = "UPDATE `prescript_test_details` SET `test_report`=?,`labratorian_id`=?,`status`=?,`report_details`=? WHERE `id`=$test_id[$count]";

        $STH = $this->DBH->prepare($query);
        $STH->bindParam(1, $pic[$count]);
        $STH->bindParam(2, $this->labarotorian_id);
        $STH->bindParam(3, $this->status); 
        $STH->bindParam(4, $report_details[$count]); 
        $STH->execute();
        $count++;
        }

       

    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `prescript_test_details` WHERE id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }
}