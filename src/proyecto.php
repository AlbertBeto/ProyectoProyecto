<?php

$proyecto_id = $_GET['id'];
    if (is_null($proyecto_id)){
    header("Location: index.php");
    exit();
}

include("templates/header.php");
include_once("mysql/db_credenciales.php");
include_once("mysql/proyecto_sql.php");
include_once("mysql/categoria_sql.php")
;

$conn=open_connection();

$proyecto = get_proyecto_detail($conn, $proyecto_id);
?>

<div class="container">
    <h2><?php echo utf8_encode($proyecto['titulo']) ?></h2>
    <span>Categorías: </span>
    <?php foreach(get_categorias_por_proyecto($conn, $proyecto['id']) as $categoria): ?>
        <a href="#" class="badge bg-secondary"><?php echo utf8_encode($categoria['nombre'])?></a>
    <?php endforeach; ?>
    <br> <br>
    <div class="row">
        <div class="col-sm">
        <img class="card-img-top" src="<?php echo (($proyecto['imagen']!=NULL) ? $proyecto['imagen']  : "/static/images/picture-not-available.jpg");?> "alt="<?php echo utf8_encode($proyecto['titulo'])?>" class="img-fluid rounded">
            <br>
        </div>
        <div class="col-sm">
            <?php echo utf8_encode($proyecto['descripcion']) ?>
        </div>
    </div>
</div>

<?php include("templates/footer.php"); ?>
<?php close_connection($conn); ?>