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

//UD5.3 5.3.g RA6.c Las creo para busquedas en la BD para usarlas en la función de confirmación desesion y admin de un usuario.
//En esta con el email de un usario sacamos un array con todos los detalles del usuario. 
//Puede plantear un probelma de seguridad y a lo mejor sería mas recomendado crear un par de funciones devolviendo solo lo que necesitamos como id y si es admin. 
function get_usuario_completo($conn, $email){
    $usuario_completo = "SELECT * FROM usuario WHERE email='$email'";
    $consulta = $conn->prepare($usuario_completo);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

//UD5.3 5.3.g RA6.c Las creo para busquedas en la BD para usarlas en la función de confirmación desesion y admin de un usuario.
//En esta con un id de usuario vemos si tiene una sesion creada. 
function get_usuario_sesiones($conn, $id){
    $usuario_completo = "SELECT id FROM sesion WHERE usuario='$id'";
    $consulta = $conn->prepare($usuario_completo);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchColumn();
}



?>