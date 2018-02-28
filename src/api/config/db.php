<?php
class DB{

    /**
     * Database Properties
     */
    private  $DBHost= '127.0.0.1';
    private  $DBUser= 'root';
    private  $DBPass= '';
    private  $DBName= 'forum';


    public function connect(){
        try{
            $mysql_connect_str= "mysql:host=$this->DBHost;dbname=$this->DBName";
            $conn= new PDO($mysql_connect_str,$this->DBUser,$this->DBPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $conn;
        }catch (PDOException $e){
//            die("Connection Failed: ". $e->getMessage());
            $exception='{"code":550,"status":"'.$e->getMessage().'"}';
            die($exception);
        }

    }

}