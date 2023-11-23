<?php include("templates/header.php"); ?>
<div class="container">
<div class="alert alert-success mt-5">
Ha creado o modificado satisfactoriamente el proyecto.
</div>
<div>
    <!-- //UD5.5 5.5.b RA6.e Cogemos el id de la url para cargar la web de modificación de proyecto -->
<a class="btn btn-xs btn-info float-right" href="formulario_mod_proyecto.php?id=<?php echo ($_GET["id"]) ?>">
Ir a proyecto
</a>
</div>
</div>
<?php include("templates/footer.php"); ?>