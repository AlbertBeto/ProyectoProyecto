<?php include_once("templates/header.php");?>
<?php include_once("mysql/db_credenciales.php"); ?>
<?php include_once("mysql/proyecto_sql.php"); ?>
<?php //include_once("mysql/categoria_sql.php"); ?>
<?php //UD5.2 5.2.1 RA6.b doy acceso a la web con las funciones para conectar y desconectar la BD pero las cargo en header.
//include_once("mysql/db_access.php");


//UD5.4 5.4.b Leo el parametro categoria de la url
$categoria_id = $_GET['categoria'];
//UD5.4 5.4.b Creo un if que dependiendo si hay valor o no en el parametro categoria
//carga un listado de proyectos completo o reducido por categoria
$proyectosTry = is_null($categoria_id)? get_proyectos_all($conn) : get_proyectos_por_categoria($conn, $categoria_id);
  
?>

<div>
    <!--UD4 4.2.a RA3.e  Creo un boton en index que lleve a la página formulario_proyectos-->  
    <?php  if (isset($_SESSION["user_email"])) { ?>  
<button onclick="location.href='formulario_proyectos.php'" type="button">
         Crear proyecto</button>
         <?php } ?>
</div>     
<!-- 3.2.f Monto dos botones para que carguen direcciones diferentes por el valor del sort. -->
<div> 
<br>     
<button onclick="location.href='index.php'" type="button">
         Ascendente Nombre</button>

         <button onclick="location.href='index.php'" type="button">
         Descendente Nombre</button>
         <br>
<button onclick="location.href='index.php'" type="button">
        Ascendente Fecha</button>

        <button onclick="location.href='index.php'" type="button">
        Descendente Fecha</button>
        <br>
</div>

<?php
//UD5.2 5.2.1 RA6.b creo la variable $conn llamando a la funcion de crear conexión.
$conn=open_connection();


?>
<div class="container mb-5">
   <div class="row">
   <?php foreach($proyectosTry as $proyecto): ?>
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
           <!--UD5.4 5.4.b Linkeo las etiquetas de categoria a index con parametro -->
       <a href="index.php?categoria=<?php echo $categoria['id']?>" class="badge bg-secondary"><?php echo utf8_encode($categoria['nombre'])
       ?></a>
       <?php endforeach; ?>
       </div>
   <?php endforeach; ?>
   </div>
</div>
<?php include("templates/footer.php"); ?>
<?php //UD5.2 5.2.1 RA6.b llamo a la función cerrar conexión y le doy los datos de la conexión y esta procede a cerrar la conn.
close_connection($conn); ?>



