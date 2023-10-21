<?php include("templates/header.php");?>
<?php include_once("datos.php"); ?>



<?php 
    // Importante recordar poner en el navegador al final de url el valor de sort
    // Ejemplo----- http://localhost:8080/index.php?sort=-1
    $sort = $_GET['sort'];
    //El ISSET es para confirmar sort está lleno. 
    if(ISSET ($_GET['sort']) && $sort === "-1"){
        usort($proyectos,'ordenaTituloProyectoDesc');
    } //Monto aquí un segundo get para confirmar que la web si tiene $sort 1 active funcion Ascendente
    elseif (ISSET ($_GET['sort']) && $sort === "1"){
        usort($proyectos,'ordenaTituloProyectoAsc');
    };
    

// UD3.3.h Creo un php que comprueba si está el parametro delete y si es true borra el la última entrada del array proyectos. 
if(ISSET ($_GET['delete']) && $_GET['delete'] === "true"){
    array_pop($proyectos);
}



?>
<div>
    <!--UD4 4.2.a RA3.e  Creo un boton en index que lleve a la página formulario_proyectos-->    
<button onclick="location.href='formulario_proyectos.php'" type="button">
         Crear proyecto</button>
</div>     
<!-- 3.2.f Monto dos botones para que carguen direcciones diferentes por el valor del sort. -->
<div> 
<br>     
<button onclick="location.href='index.php'" type="button">
         Up</button>

         <button onclick="location.href='index.php'" type="button">
         Down</button>
         <br>
</div>


<div class="container mb-5">
<br>  

<div class="row">
    <?php dateConversor($proyectos); foreach($proyectos as $proyecto): ?>
        <div class="col-sm-3">
            <!-- UD3.3.d Modifico el href del a para dirigirlo a la web del proyecto -->
            <a href="proyecto.php?id=<?php echo $proyecto['clave'] ?>" class="p-5">
                <div class="card">
                <!-- UD3.2.d Introduzco un php con un if por si no tiene dirección de imagen cargar imagen sinImagen -->
                <img class="card-img-top" src=  <?php echo (empty($proyecto['imagen'])) ? 'static/images/picture-not-available.jpg':$proyecto['imagen'] ?> alt="<?php echo $proyecto['titulo']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $proyecto['titulo']?></h5>
                        <p class="card-text"><?php echo $proyecto['descripcion']?></p>
                        <!--UD 3.3.c Creo un foreach para que repase los valores del array categorias, mire si existen en el array categorias main y en caso afirmativo imprime el valor de categoriasMain  -->
                        <?php
                        foreach($proyecto['categorias'] as $cat){
                                if(array_key_exists($cat,$categoriasMain)){
                                echo $categoriasMain[$cat]." ";
                                }
                            } 
                        ?>                                                                           
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
<p>Esto es zona de pruebas:
    Cuantos proyectos hay: <?php echo count($proyectos)?>;
    El interior de la última posición es:<?php print_r($proyectos[count($proyectos)-1])?>
</p>
</div>
<?php include("templates/footer.php");?>