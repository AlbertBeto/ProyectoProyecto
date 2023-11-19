<?php 
 
include("templates/header.php"); ?>

<?php
    //$contactosLista = json_decode(file_get_contents('mysql/contactos.json'), true);
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

<?php include("templates/footer.php"); ?>