<?php include("templates/header.php"); ?>
<?php include("datos.php"); ?>

    <div class="container">
        <h2>Título de muestra</h2>
        <h4><a href="#">Año</a></h4>
        <span>Categorías: </span>
        <a href="#"><button class="btn btn-sm btn-default">Categoría 1</button></a>
        <br> <br>
        <div class="row">
            <div class="col-sm">
               <!-- UD3.2.d Introduzco un php con un if por si no tiene dirección de imagen cargar imagen sinImagen -->
                <img src= <?php echo (empty($proyecto['imagen'])) ? 'static/images/picture-not-available.jpg':$proyecto['imagen'] ?>  alt="Proyecto 1" class="img-responsive">
                <br>
            </div>
            <div class="col-sm">
                Descripción
            </div>
        </div>
    </div>
<?php include("templates/footer.php"); ?>