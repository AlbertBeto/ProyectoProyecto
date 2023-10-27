<?php
include_once("mysql/db_credenciales.php");

function open_connection(){

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       return $conn;
    } catch(PDOException $e) {
        $conn = null;
        echo "La conexión ha fallado: " . $e->getMessage();
    }
}

function close_connection($conn){
    $conn = null;
}




?>