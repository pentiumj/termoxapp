<?php require_once "../app/config.php";

class Modelo{
 
    protected $_db;

    public function __construct(){
       $this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);  

       if ( $this->_db->connect_errno )
       {
        echo "Fallo al conectar a MySQL";
        return; 
       }

       $this->_db->set_charset("utf8");


    }
}