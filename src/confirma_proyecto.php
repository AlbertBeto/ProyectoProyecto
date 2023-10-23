<?php include("templates/header.php"); ?>
<div class="container">
<div class="alert alert-success mt-5">
Ha creado o modificado satisfactoriamente el nuevo proyecto.
</div>
<div>
    <!-- UD4.2 RA3.e 4.2.f Cogemos el id de la dirección para cargar la ficha del proyecto -->
<a class="btn btn-xs btn-info float-right" href="proyecto.php?id=<?php echo ($_GET["id"]) ?>">
Volver al inicio
</a>
</div>
</div>
<?php include("templates/footer.php"); ?>