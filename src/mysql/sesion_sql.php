<?php

//UD5.3 5.3.g RA6.c Las creo para busquedas en la BD para usarlas en la función de confirmación desesion y admin de un usuario.
//En esta con un id de usuario vemos si tiene una sesion creada. 
function get_usuario_sesiones($conn, $id){
    $usuario_completo = "SELECT id FROM sesion WHERE usuario='$id'";
    $consulta = $conn->prepare($usuario_completo);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchColumn();
}

//UD5.5 5.5.a RA6.e 

function todas_las_sesiones($conn){
    $all_seasons = "SELECT id FROM sesion";
    $consulta = $conn->prepare($all_seasons);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    $consulta->fetchAll();
    //Si $consulta vuelve null pq no hay ninguna conexion devuelvo el valor de un array con un 1 dentro. 
    if(is_null($consulta)){
        return [1];
    }else{return $consulta;}
}

function encontrar_faltantes($sesiones){
    //Aquí saco el número mas alto almacenado en el array $sesiones
    $maximo = max($sesiones);
    //Creo un array desde el cero hasta el número maximo del array $sesiones.
    $todos_los_numeros = range(1, $maximo);
    //Aqui monto otro array con las diferencias o numeros diferentes entre las dos arrays. 
    $puestos_vacios = array_diff($todos_los_numeros,$sesiones);
    // Compruebo puestos_vacios y si no hay paso el número max+1 y si lo hay paso el número mas bajo de la lista. 
    if(empty($puestos_vacios)){
        return 1;
    }else{
        return min($puestos_vacios);}
}

function new_sesion($conn,$id_usuario){
    $listado_sesiones = todas_las_sesiones($conn);
    $posicion_id_sesion = encontrar_faltantes($listado_sesiones);
    $nueva_sesion = "INSERT INTO sesion (id, usuario) VALUES ($posicion_id_sesion, $id_usuario)";
    $consulta = $conn->prepare($nueva_sesion);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();

}



?>