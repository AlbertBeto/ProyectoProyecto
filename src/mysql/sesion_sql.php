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

//UD5.5 5.5.a RA6.e Aqui m e he flipado un poco... ya que queria que las nuevas sesiones se guardaran aprovechando los agujeros en la lista
// no queria una mega lista de sesiones son simplemente decir length+1. Con lo que he creado un par de funciones para saber los espacios vacios en la lista de 
//sesiones y si no hay agujeros que ponga la nueva sesion al final. 
//Primero creo una variable que devuelve todas las sesiones en la tabla sesion

function todas_las_sesiones($conn){
    $all_seasons = "SELECT id FROM sesion";
    $consulta = $conn->prepare($all_seasons);
    $isOK = $consulta->execute();
    $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    //Si $consulta vuelve null pq no hay ninguna conexion devuelvo el valor de un array con un 1 dentro. 
    if(empty($resultado)){
        return [1];
    }else{return $resultado;}
}

//UD5.5 5.5.a RA6.e En esta funcion cojo el listado de sesiones y miro si hay huecos libres entre los ids de sesion. 
function encontrar_faltantes($sesiones){
    //Ordeno el array de sesiones
    sort($sesiones);
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

//UD5.5 5.5.a RA6.e Esta es la funcion principal para crear sesiones en la tabla sesion y donde uso las funciones anteriores.
function new_sesion($conn,$id_usuario){
    //Primeor saco un listado con todas las sesiones.
    $listado_sesiones = todas_las_sesiones($conn);
    //Paso el listado por el busca huecos que me devuelve la posición correcta. 
    $posicion_id_sesion = encontrar_faltantes($listado_sesiones);
    //Aqui monto el query diciendole qué y donde tiene que meter los datos en la tabla sesion. 
    $nueva_sesion = "INSERT INTO sesion (id, usuario) VALUES ($posicion_id_sesion, $id_usuario)";
    $consulta = $conn->prepare($nueva_sesion);
    $isOK = $consulta->execute();
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    

}

//UD5.5 5.5.b RA6.e Función en la que recibe conexión y email y borra en la base de datos la sesion del usuario. 
function delete_sesion($conn,$email){
    //Consigo el id del usuario con función
    $id_usuario_delete = get_id_usuario($conn, $email);
    //query donde borro linea en la tabla sesion donde usuario se igual a la id de usuario previamente guardad
    $borra_sesion = "DELETE FROM sesion WHERE usuario = $id_usuario_delete";
    $consulta = $conn->prepare($borra_sesion);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
}



?>