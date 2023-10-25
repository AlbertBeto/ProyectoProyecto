<?php include("templates/header.php"); ?>
<?php include("datos.php"); ?>
<?php include("mysql/db_credenciales.php"); ?>
<?php include("mysql/proyecto_sql.php"); ?>

<!-- UD3.3.d con PHP recupero el id con un get y lo busco en los arrays y una vez encontrado guardo la posición del proyecto. -->
<?php $proyectop = $_GET["id"]; 
$posicion=null;
foreach($proyectos as $key => $titulopro){
    if($titulopro["clave"]===$proyectop){
    $posicion = $key;
    break;
    }
} 


?>


    <div class="container">
        <!-- UD3.3.d Utilizando la posición del array saco los datos a imprimir en pantalla en cada posición.-->
        <h2><?php echo $proyectos[$posicion]["titulo"]; ?></h2>
        <h4><a href="#"><?php echo $proyectos[$posicion]["fecha"];?></a></h4>
        <br> <br>
        <div class="row">
            <div class="col-sm">
               <!-- UD3.2.d Introduzco un php con un if por si no tiene dirección de imagen cargar imagen sinImagen -->
               <!-- UD3.2.d Usando posición cambio la imagen del proyecto.  -->
                <img src= <?php echo (empty($proyectos[$posicion]["imagen"])) ? 'static/images/picture-not-available.jpg':$proyectos[$posicion]['imagen']; ?> width="350px" alt="Proyecto 1" class="img-responsive">
                <br>
            </div>
            <div class="col-sm">
                Descripción:
                <br>
                <!-- UD3.3.d Utilizo nl2br para la descripción.  -->
                <?php echo nl2br($proyectos[$posicion]["descripcion"]) ?>
            </div>
            <span>Categorías: </span>
        <a href="#"><button class="btn btn-sm btn-default"></button></a>
              <!--UD 3.3.c Creo un foreach para que repase los valores del array categorias del proyecto escogido, mire si existen en el array categorias main y en caso afirmativo imprime el valor de categoriasMain  -->
            <?php foreach($proyectos[$posicion]["categorias"] as $cat){
                                if(array_key_exists($cat,$categoriasMain)){
                                echo $categoriasMain[$cat]." ";
                                }
                            } 
                        ?>   
        </div>
    </div>
    <br>
    <br><br><br>
<?php include("templates/footer.php"); ?>