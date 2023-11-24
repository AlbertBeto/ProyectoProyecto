<?php include_once("templates/header.php"); ?>
<?php include_once("mysql/db_credenciales.php"); ?>
<?php include_once("mysql/proyecto_sql.php"); ?>
<?php include_once("utiles.php");
include_once("mysql/usuario_sql.php"); ?>

<?php //UD5.2 5.2.1 RA6.b doy acceso a la web con las funciones para conectar y desconectar la BD pero las cargo en header.
//include_once("mysql/db_access.php");


//UD5.4 5.4.b Leo el parametro categoria de la url
$categoria_id = $_GET['categoria'];

//UD5.4 5.4.c RA6.d Leo el parametro order de la url
$order_set = $_GET['order'];

//UD5.6 5.6.b RA6.f Guardo el parametro borrado de url
$borrado= $_GET['borrado'];

//UD5.4 5.4.b Creo un if que dependiendo si hay valor o no en el parametro categoria
//carga un listado de proyectos completo o reducido por categoria
//$proyectosTry = is_null($categoria_id)? get_proyectos_all($conn) : get_proyectos_por_categoria($conn, $categoria_id);
//UD5.4 5.4.c RA6.d Creo una variable null a la que le doy valor según la lectura de los parametros entregados por url
// y usados en las funciónes. dependiendo el valor de las lecturas. 
$proyectosTry = null;
if (is_null($categoria_id) & is_null($order_set)) {
    $proyectosTry = get_proyectos_all($conn);
} elseif (!is_null($categoria_id) & is_null($order_set)) {
    $proyectosTry = get_proyectos_por_categoria($conn, $categoria_id);
} elseif (is_null($categoria_id) & !is_null($order_set)) {
    $proyectosTry = get_proyectos_order_by($conn, $order_set);
} elseif (!is_null($categoria_id) & !is_null($order_set)) {
    $proyectosTry = get_proyectos_por_categoria_ordenado($conn, $categoria_id, $order_set);
};


?>
<div>
    <?php 
    //UD5.6 5.6.b RA6.f Mensaje de borrado ok si se ha pasado el parametro borrado=true en la url
    if($borrado) echo ("<p>Proyecto borrado exitosamente.</p>");
    ?>
    <!--UD5.5 5.5.b RA6.e Usando get_user_logged_in solo aparece el boton de crear proyectos para los admin. -->
    <?php if (get_user_logged_in()) { ?>
        <button onclick="location.href='formulario_proyectos.php'" type="button">
            Crear proyecto</button>
    <?php } ?>
</div>
<!-- //UD5.4 5.4.c RA6.d Monto dos juegos de botones para que carguen direcciones diferentes por el valor del sort.
Y manteniedo por php si hay parametro categoria y si es el caso manteniendolo.  -->
<div>
    <br>
    <button onclick="location.href='index.php?<?php if ($categoria_id !== null) echo 'categoria=' . $categoria_id . '&'; ?>order=nomasc'" type="button">
        Ascendente Nombre</button>

    <button onclick="location.href='index.php?<?php if ($categoria_id !== null) echo 'categoria=' . $categoria_id . '&'; ?>order=nomdes'" type="button">
        Descendente Nombre</button>
    <br>
    <button onclick="location.href='index.php?<?php if ($categoria_id !== null) echo 'categoria=' . $categoria_id . '&'; ?>order=fecasc'" type="button">
        Ascendente Fecha</button>

    <button onclick="location.href='index.php?<?php if ($categoria_id !== null) echo 'categoria=' . $categoria_id . '&'; ?>order=fecdes'" type="button">
        Descendente Fecha</button>
    <br>
</div>
<br>
<?php
//UD5.2 5.2.1 RA6.b creo la variable $conn llamando a la funcion de crear conexión.
$conn = open_connection();


?>
<div class="container mb-5">
    <div class="row">
        <?php //UD5.4 5.4.b RA6.d Aquí utilizo la variable a la que le he dado valor de las busqueadas sql de las funciones segun el valor de los paremetros de la url. 
        foreach ($proyectosTry as $proyecto) : ?>
            <div class="col-sm-3">
                <!-- <a href="proyecto.php?id=<?php echo $proyecto['id'] ?>" class="p-5"> -->
                <a href="<?php if (isset($_COOKIE["user_email"])) { ?>formulario_mod_proyecto.php?id=<?php echo $proyecto['id'];
                                                                                                } else { ?>proyecto.php?id=<?php echo $proyecto['id'];
                                                                                                                                                    } ?>" class="p-5">
                    <div class="card">
                        <img class="card-img-top" src="<?php echo (($proyecto['imagen'] != NULL) ? $proyecto['imagen']  : "/static/images/picture-not-available.jpg"); ?> " alt="<?php echo utf8_encode($proyecto['titulo']) ?> ">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo utf8_encode($proyecto['titulo']) ?></h5>
                            <p class="card-text"><?php echo utf8_encode($proyecto['descripcion']) ?></p>
                        </div>
                    </div>
                </a>
                <?php foreach (get_categorias_por_proyecto($conn, $proyecto['id']) as $categoria) : ?>
                    <!--UD5.4 5.4.b Linkeo las etiquetas de categoria a index con parametro -->
                    <a href="index.php?categoria=<?php echo $categoria['id'] ?>" class="badge bg-secondary"><?php echo utf8_encode($categoria['nombre'])
                                                                                                            ?></a>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include("templates/footer.php"); ?>
<?php //UD5.2 5.2.1 RA6.b llamo a la función cerrar conexión y le doy los datos de la conexión y esta procede a cerrar la conn.
close_connection($conn); ?>