<?php ?>
<?php 
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

    //UD5.3 5.3.g RA6.c De momento no la creo y paso a siguientes
function get_user_logged_in(){

}


?>
