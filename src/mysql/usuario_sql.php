<?php
//UD5.3 5.3.e RA6.c Creo función que según email introducido saca el password.

function get_credenciales_usuario($conn, $email){
    $credenciales_usuario = "SELECT password FROM usuario WHERE e-mail=$email";
    $consulta = $conn->prepare($credenciales_usuario);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}


?>