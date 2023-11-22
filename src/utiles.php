<?php 
include_once ("mysql/usuario_sql.php");
include_once("mysql/db_access.php");


//Cambio la posición de a por b para que lo ordene de menor a mayor
function ordenaTituloProyectoDesc($b, $a){
return strcmp($b['titulo'],$a['titulo']);
};

// 3.2.f creo una nueva función  para ordenar ascendente.

function ordenaTituloProyectoAsc($a, $b){
return strcmp($b['titulo'],$a['titulo']);
};

/*
function probandoElConversor(){
    include("datos.php");
    foreach($proyectos as $proyecto){
        if(!is_string($proyecto["fecha"])){
            return $proyecto["fecha"];          
        }
    }
};*/

// UD3.5.a Función que devuelve el año actual.
function anyoActual(){
    return date('Y');
};

// UD3.5.b Creo una funcion que se le dá el array principal y cambia el campo fecha de string a date. 
// Utilizo el & para modificar la variable original o en este caso el array. 
function dateConversor(&$arrayOriginal){
        foreach($arrayOriginal as &$proyecto){
        if(is_string($proyecto["fecha"])){
            $proyecto["fecha"]=date('d/m/Y',strtotime($proyecto["fecha"]));
           }
        } 
        return $arrayOriginal;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

    //UD5.3 5.3.g RA6.c Creo una estructura de ifs y creo un par de funciones de busquedas en la BD en 
    //usuario_sql.php como get_usuario_completo y get_usuario_sesiones.
    //Resumiendo confirma que el la cookies exista, que el email de la cookie existe en la base de datos
    //que el usuario tiene una sesion abierta en la bd  y por último que se admi si falla alguna devuelve false.   
function get_user_logged_in(){
    $conn=open_connection();
    if (isset($_COOKIE["user_email"])) {
        $email=$_COOKIE["user_email"];
        if(!is_null(get_existe_usuario($conn, $email))){
            $usuario=get_usuario_completo($conn, $email);
            if(!is_null(get_usuario_sesiones($conn,$usuario[0]["id"]))){
                if($usuario[0]["Admin"]==1){
                    return true;
                }else{return false;};
                
            }else{return false;};
        }else{return false;};
    }else{return false;};
    close_connection($conn);
}


?>
