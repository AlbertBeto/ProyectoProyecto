<?php include("templates/header.php");?>
<?php include("mysql/db_credenciales.php"); ?>
<?php include("mysql/proyecto_sql.php"); ?>
<?php include("mysql/categoria_sql.php"); ?>

<?php 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch(PDOException $e) {
    echo "La conexión ha fallado: " . $e->getMessage();
}



?>
<div class="container mb-5">
    <div class="row">
    <?php foreach(get_proyectos_all($conn) as $proyecto): ?>
        <div class="col-sm-3">
            <a href="proyecto.php?id=<?php echo $proyecto['id']?>" class="p-5">
                <div class="card">
                    <img class="card-img-top" src="<?php echo $proyecto['imagen']?>" alt="<?php echo
                    utf8_encode($proyecto['titulo'])?>">
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
<?php $conn = null; ?>