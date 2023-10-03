<?php include("datos.php"); ?>;


<?php 



//Cambio la posición de a por b para que lo ordene de menor a mayor

function ordenaTituloProyectoDesc($b, $a){
return strcmp($b['titulo'],$a['titulo']);
};

// 3.2.f creo una nueva función  para ordenar ascendente.

function ordenaTituloProyectoAsc($a, $b){
return strcmp($b['titulo'],$a['titulo']);
};

//
function probandoElConversor(){
    include("datos.php");
    foreach($proyectos as $proyecto){
        if(!is_string($proyecto["fecha"])){
            return $proyecto["fecha"];          
        }
    }
};

// UD3.5.a Función que devuelve el año actual.
function anyoActual(){
    return date('Y');
};

// UD3.5.b Creo una funcion que se le dá el array principal y cambia el campo fecha de string a date. 
function dateConversor(&$arrayOriginal){
        foreach($arrayOriginal as &$proyecto){
        if(is_string($proyecto["fecha"])){
            
            $proyecto["fecha"]=date('d/m/Y',strtotime($proyecto["fecha"]));
           }
        } 
        return $arrayOriginal;
}

?>

