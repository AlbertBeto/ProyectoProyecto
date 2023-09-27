<?php include("templates/header.php");?>
<?php include("datos.php"); ?>
<?php include("utiles.php"); ?>


<?php 
    // Importante recordar poner en el navegador al final de url el valor de sort
    // Ejemplo----- http://localhost:8080/index.php?sort=-1
    $sort = $_GET['sort'];
    //El ISSET es para confirmar sort está lleno. 
    if(ISSET ($_GET['sort']) && $sort === "-1"){
        usort($proyectos,'ordenaTituloProyectoDesc');
};
?>


<div class="container mb-5">
    <div class="row">
    <?php foreach($proyectos as $proyecto): ?>
        <div class="col-sm-3">
            <a href="#" class="p-5">
                <div class="card">
                    <!-- Esta es la linea anterior del if <img class="card-img-top" src="<?php echo $proyecto['imagen']?>" alt="<?php echo $proyecto['titulo']?>"> -->
                <img class="card-img-top" src="<?php echo 
                <?php if ($proyecto['imagen']!=null){$proyecto['imagen']}else{'static/images/picture-not-available.jpg'}?>
                " alt="<?php echo $proyecto['titulo']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $proyecto['titulo']?></h5>
                        <p class="card-text"><?php echo $proyecto['descripcion']?></p>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
</div>
<?php include("templates/footer.php");?>