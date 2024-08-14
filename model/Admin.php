<?php
/**
 * Created by PhpStorm.
 * User: Tusar
 * Date: 11/26/2017
 * Time: 7:16 PM
 */

namespace App;
use PDO;

class Admin 
{
	public $id;
	public $name;
	public $email;
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

        if (array_key_exists('name', $data)) {
            $this->name = $data['name'];
        }
        if (array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }

        if (array_key_exists('password', $data)) {
            $this->password = md5($data['password']);
        }

        return $this;

    }
    public function loginCheck(){
        $query = "SELECT * FROM `admin` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH=$this->DBH->query($query);
        $STH->setFetchMode(PDO::FETCH_ASSOC);
        $STH->fetchAll();

        $sql = "SELECT * FROM `admin` WHERE `email`='$this->email' AND `password`='$this->password'";
        $STH2=$this->DBH->query($sql);
        $STH2->setFetchMode(PDO::FETCH_OBJ);
        $adminData=$STH2->fetch();
        if($adminData){
        $_SESSION['admin_id']=$adminData->id;
        }

        $count = $STH->rowCount();
        if ($count > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function changePassword()
    {
        $query ="UPDATE `admin` SET `password`=? WHERE `id`=$this->id";
        $STH =$this->DBH->prepare($query);
        $STH->bindParam(1,$this->password);
        $STH->execute();
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
    public function ViewProfile($id){
        $sql="SELECT * FROM `admin` WHERE id=$id";
        $data=$this->DBH->prepare($sql);
        $data->execute();
        $alldata=$data->fetch(PDO::FETCH_OBJ);
        return $alldata;
    }
}