<?php 
//Cambio la posición de a por b para que lo ordene de menor a mayor

function ordenaTituloProyectoDesc($b, $a){
return strcmp($b['titulo'],$a['titulo']);
};

// 3.2.f creo una nueva función  para ordenar ascendente.

function ordenaTituloProyectoAsc($a, $b){
return strcmp($b['titulo'],$a['titulo']);
} ?>