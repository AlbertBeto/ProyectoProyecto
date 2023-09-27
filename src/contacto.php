<?php include("templates/header.php"); ?>
<!-- UD3.2.c.1 Hago un include en para dar acceso a datos en la pagina contacto -->
<?php include("datos.php"); ?>
<div class="container">
<h2 class="mb-5">Contacto</h2>
<div class="row">
<div class="col-md">
<img src="static/images/businessman.png" class="img-fluid rounded">
</div>
<div class="col-md">
    <!-- UD3.2.c.2 Hago que H3 saque la info de datos.php -->
<h3><?php echo $nombreApellidos ?></h3>
<p>Ciclo Superior DAW.</p>
<p>Apasionado del mundo de la programación en general, y de las tecnologías web en
particular.</p>
<p>Si tienes cualquier tipo de pregunta, contacta conmigo por favor.</p>
<p>Teléfono: 87654321</p>
</div>
</div>
</div>
<?php include("templates/footer.php"); ?>