<?php
//UD5.3 5.3.e RA6.c Creo función que según email introducido saca el password.

function get_credenciales_usuario($conn, $email){
    $credenciales_usuario = "SELECT passwordW FROM usuario WHERE email='$email'";
    $consulta = $conn->prepare($credenciales_usuario);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchColumn();
}


//UD5.3 5.3.e Creo una función que devuelve el email si existe el email para confirmar que existe un email dentro de la bd.
function get_existe_usuario($conn, $email){
    $credenciales_usuario = "SELECT email FROM usuario WHERE email='$email'";
    $consulta = $conn->prepare($credenciales_usuario);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchColumn();
}

?>