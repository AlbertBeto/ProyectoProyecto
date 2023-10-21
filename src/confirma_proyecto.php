<?php include("templates/header.php"); ?>
<div class="container">
<div class="alert alert-success mt-5">
Ha creado o modificado satisfactoriamente el nuevo proyecto.
</div>
<div>
<a class="btn btn-xs btn-info float-right" href="/">
Volver al inicio
</a>
</div>
<p>Esto es zona de pruebas:
    Cuantos proyectos hay: <?php echo count($proyectos)?>;
    El interior de la última posición es:<?php print_r($proyectos[count($proyectos)-1])?>
    El interior de la última posición es:<?php print_r($neoProyecto[count($neoProyecto)-1])?>
    El interior de la última posición es:<?php print_r($neoProyecto)?>
    $claveErr <?php print_r($claveErr)?>
    $tituloErr <?php print_r($tituloErr)?>
    $fechaproyectErr <?php print_r($fechaproyectErr)?>
    $descripcionProyectoErr <?php print_r($descripcionProyectoErr)?>
    $archivoProyectoErr<?php print_r($archivoProyectoErr)?>
</p>
</div>
<?php include("templates/footer.php"); ?>