<?php 
 
include("templates/header.php");
include_once ("mysql/sesion_sql.php");
include_once("mysql/db_access.php");
?>

<?php
$conn=open_connection();
//UD5.5 5.5.a RA6.e 
    echo ("ostias".get_usuario_sesiones($conn, 1));
?>

<div class="container mb-5">
    <h1>Lista de contactos</h1>

    <?php if ($contactosLista === NULL) { ?>
        <div class="alert alert-info mt-5">
            Aún no ha sido contactado
        </div>
    <?php } else { ?>
        <div class="list-group">
            <?php foreach ($contactosLista as $contacto): ?>
            <a href="contacto_detalle.php?id=<?php echo $contacto['id'] ?>" class="list-group-item list-group-item-action"><?php echo $contacto['email'] ?> -
            <?php echo $contacto['telefono'] ?></a>
            <?php endforeach; ?>
        </div>
    <?php } ?>
</div>

<?php include("templates/footer.php");
close_connection($conn);
 ?>