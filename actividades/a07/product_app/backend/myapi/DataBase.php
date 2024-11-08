<?php

//namespace TECWEB1/MYAPI

abstract class DataBase {
    protected $conexion = NULL;
    
    public function __construct($user,$pass,$db) {
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );
        if (!$this->conexion) {
            die('Error de conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
}
?>