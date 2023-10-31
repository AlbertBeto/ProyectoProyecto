<?php include_once("templates/header.php");?>
<?php include_once("mysql/db_credenciales.php"); ?>
<?php include_once("mysql/proyecto_sql.php"); ?>
<?php include_once("mysql/categoria_sql.php"); ?>
<?php //UD5.2 5.2.1 RA6.b doy acceso a la web con las funciones para conectar y desconectar la BD
include_once("mysql/db_access.php"); ?>

<?php 
//UD5.2 5.2.1 RA6.b creo la variable $conn llamando a la funcion de crear conexión. 
$conn=open_connection();

?>
<div class="container mb-5">
    <div class="row">
    <?php foreach(get_proyectos_all($conn) as $proyecto): ?>
        <div class="col-sm-3">
            <a href="proyecto.php?id=<?php echo $proyecto['id']?>" class="p-5">
                <div class="card">
                    <img class="card-img-top" src="<?php echo (($proyecto['imagen']!=NULL) ? $proyecto['imagen']  : "/static/images/picture-not-available.jpg");?> "alt="<?php echo utf8_encode($proyecto['titulo'])?> ">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo utf8_encode($proyecto['titulo']) ?></h5>
                        <p class="card-text"><?php echo utf8_encode($proyecto['descripcion'])?></p>
                    </div>
                </div>
            </a>
        <?php foreach(get_categorias_por_proyecto($conn, $proyecto['id']) as $categoria): ?>
        <a href="#" class="badge bg-secondary"><?php echo utf8_encode($categoria['nombre'])
        ?></a>
        <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
    </div>
</div>
<?php include("templates/footer.php"); ?>
<?php //UD5.2 5.2.1 RA6.b llamo a la función cerrar conexión y le doy los datos de la conexión y esta procede a cerrar la conn.
close_connection($conn); ?>