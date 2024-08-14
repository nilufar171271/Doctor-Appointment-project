<?php
namespace App;
use PDO;


class Specialist
{
    private $DBH;
    public $specialist_id;
    public $specialist;

    public function __construct(PDO $pdo)
    {
        $this->DBH = $pdo;
        
    }
    public function preparedata($data)
    {
        if (array_key_exists('specialist_id', $data)) {
            $this->specialist_id = $data['specialist_id'];
        }

        if (array_key_exists('specialist', $data)) {
            $this->specialist = $data['specialist'];
        }


        return $this;

    }
    public function store()
    {
        $query ="INSERT INTO `specialist_lookup`(`specialist`) VALUES (?)";
        $STH=$this->DBH->prepare($query);
        $STH->bindParam(1, $this->specialist);
        $STH->execute();
    }

    public function show(){
        $sql="SELECT * FROM `specialist_lookup`";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetchAll(PDO::FETCH_OBJ);

        return $alldata;
    }
    public function singleRowData($id)
    {
        $sql = "SELECT * FROM `specialist_lookup` WHERE `specialist_id`=?";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();
        $oneRowData = $data->fetch(PDO::FETCH_OBJ);
        return $oneRowData;
    }
    public function update()
    {

        $query = "UPDATE `specialist_lookup` SET `specialist`=? WHERE `specialist_id`=?";

        $STH = $this->DBH->prepare($query);

        $STH->bindParam(1,$this->specialist);
        $STH->bindParam(2,$this->specialist_id);

        $STH->execute();

    }

    public function destroy($id)
    {
        $sql = "DELETE FROM `specialist_lookup` WHERE `specialist_id`=?";
        $data = $this->DBH->prepare($sql);
        $data->bindParam(1,$id);
        $data->execute();


    }

}