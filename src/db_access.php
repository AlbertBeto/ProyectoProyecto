<?php
//include("mysql/db_credenciales.php");

//UD5.2 5.2.1 RA6.b Creo dos funciones una para abrir la conexión a la base de
//datos y otra para cerrar la conexión. 
function open_connection(){
//Pongo los datos de db_credenciales.php directamente en la función ya que
//si no los pongo no conecta con la base de datos. 
    $servername = "mysql:3306";
    $username = "admin";
    $password = "admin";
    $db = "portfolio_db";
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