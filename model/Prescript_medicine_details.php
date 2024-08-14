<?php

namespace App;
use App\Database;
use PDO;

class Prescript_medicine_details 
{

    public $id;
    public $prescript_id;
    public $med_name;
    public $med_taking_time;
    public $med_taking_dura;

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
            $this->prescript_id= $data['prescript_id'];
        }
        if (array_key_exists('med_name', $data)) {
            $this->med_name= $data['med_name'];
        }
        if (array_key_exists('med_taking_time', $data)) {
            $this->med_taking_time= $data['med_taking_time'];
        }

        if (array_key_exists('med_taking_dura', $data)) {
            $this->med_taking_dura= $data['med_taking_dura'];
        }
        
        return $this;

    }
    public function store($post)
    {
        $query ="INSERT INTO `prescript_medicine_details`(`prescript_id`, `med_name`, `med_taking_time`, `med_taking_dura`) VALUES (?,?,?,?)";

        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->prescript_id);
        $STH->bindParam(2, $this->med_name);
        $STH->bindParam(3, $this->med_taking_time);
        $STH->bindParam(4, $this->med_taking_dura);

    

        $STH->execute();

    }


    public function multistore($id,$men,$time,$dua)
    {
        $query ="INSERT INTO `prescript_medicine_details`(`prescript_id`, `med_name`, `med_taking_time`, `med_taking_dura`) VALUES (?,?,?,?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $id);
        $STH->bindParam(2, $men);
        $STH->bindParam(3, $time);
        $STH->bindParam(4, $dua);

        $STH->execute();

    }


    public function showall($id){
        $sql="SELECT * FROM `prescript_medicine_details` where prescript_id=$id";
        $data=$this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }



    public function singleRowData($id)
    {
        $sql = "SELECT * FROM `prescript_medicine_details` where prescript_id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `prescript_medicine_details` SET `med_name`=?,`med_taking_time`=?,`med_taking_dura`=? WHERE `id`=$this->$id";

        $STH = $this->DBH->prepare($query);
        $STH->bindParam(1,$this->med_name);
        $STH->bindParam(2,$this->med_taking_time);
        $STH->bindParam(3,$this->med_taking_dura);
        $STH->execute();

    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `prescript_medicine_details` WHERE id=$id";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }
}