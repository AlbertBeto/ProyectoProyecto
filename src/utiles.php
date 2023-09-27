<?php 
//Cambio la posición de a por b para que lo ordene de menor a mayor

function ordenaTituloProyectoDesc($b, $a){
return strcmp($b['titulo'],$a['titulo']);
} ?>