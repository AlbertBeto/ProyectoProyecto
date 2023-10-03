<?php 
//Cambio la posición de a por b para que lo ordene de menor a mayor

function ordenaTituloProyectoDesc($b, $a){
return strcmp($b['titulo'],$a['titulo']);
};

// 3.2.f creo una nueva función  para ordenar ascendente.

function ordenaTituloProyectoAsc($a, $b){
return strcmp($b['titulo'],$a['titulo']);
};

//Esta función me la he inventado para nada... al final la he aprovechado al fin como UD3.5.x
function anyoDateString($elstring){
    return date('Y',strtotime($elstring));
};

// 3.3.a Función que devuelve el año actual.
function anyoActual(){
    return date('Y');
};


?>

