<?php include("templates/header.php");
include_once("mysql/proyecto_sql.php");
?>

<?php
//importante inicializar todas las variables a vacio. 
    $claveErr = $tituloErr = $fechaproyectErr = $descripcionProyectoErr = $archivoProyectoErr = "";
    $clave = $titulo = $fechaproyect = $descripcionProyecto = "";
    $pathArchivo = $nombreArchivo = "";
     
     
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["clave"])) {
            $claveErr = "Por favor, introduzca una clave correcta.";
        }else {
            $clave = test_input($_POST["clave"]);
            //Expresion regular para solo letras y espacios
            if (!preg_match("/^\S+$/",$clave)) {
                $claveErr = "Obligatorio. No se permiten espacios.";
            }
            };
        if (empty($_POST["titulo"])) {
            $tituloErr = "Por favor, introduzca el título del proyecto.";
        } else {
                $titulo = test_input($_POST["titulo"]);
                if (preg_match("/^.{31,}$/",$titulo)) {
                $tituloErr = "Máximo 30 caracteres.";
            }
        };
        if (empty($_POST["fechaproyect"])) {
            $fechaproyectErr = "Por favor, introduzca fecha de finalización.";
        } else {
                $fechaproyect = test_input($_POST["fechaproyect"]);
                if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/",$fechaproyect)) {
                $fechaproyectErr = "Introduzca un fecha válida.";
            }
        };
        if (empty($_POST["descripcionProyecto"])) {
            $descripcionProyectoErr = "Por favor, introduzca descripción del proyecto.";
        } else {
                $descripcionProyecto = test_input($_POST["descripcionProyecto"]);
                if (preg_match("/^.{251,}$/",$descripcionProyecto)) {
                $descripcionProyectoErr = "Máximo 250 caracteres.";
            }
        };
        //Esto es lo de subir archivos
        if (!empty($_FILES['archivo'])) {
            $nombreArchivo = $_FILES['archivo']['name'];
            move_uploaded_file($_FILES['archivo']['tmp_name'], "/var/www/html/uploads/{$nombreArchivo}");
            if ($nombreArchivo){
            $pathArchivo = "uploads/{$nombreArchivo}";
            }
            };

                // Repasa todas las variables de error y confirma que esten vacias
                //para luego crear un array con los valores de los formularios en el orden del array

        if ($claveErr === "" && $tituloErr === "" && $fechaproyectErr === "" && $descripcionProyectoErr === "") {
            
            $neoProyecto = [
            "clave" => $clave,
            "titulo" => $titulo,
            "descripcion" => $descripcionProyecto,
            "imagen" => $pathArchivo,
            "categorias" => $categorias,
            "fecha" => $fechaproyect,
            ];

            //UD5.5 5.5.b RA6.e Aqui tras confirmar que no hay errores recogemos la info de todos los inputs
            // Y que se ha lanzado el formulario llamamos a la función que inserta el nuevo proyecto en la tabla proyecto
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                new_proyecto($conn,$neoProyecto);
                //Aquí recojo el último id creado para pasarlo en la url
                $ultimo_id=$conn->lastInsertId();
            }
            
            
            ?>
                <!-- Ahora sale del minibucle del php realiza el salto de web a la pagina
                de confirmación y acaba de cerrarlo todo.   -->
        <script type="text/javascript">
         // //UD5.5 5.5.b RA6.e damos valor a id en la url usando la ultima id.
        window.location = "/confirma_proyecto.php?id=<?php echo $ultimo_id ?>";
        console.log($proyectos)
        </script>
   

<?php
        }       
    
    }
?>
<div class="container">
<h2 class="mb-5">Formulario Proyectos</h2>
<div class="row">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
<div class="mb-3 col-sm-6 p-0">
    <div class="row">
        <label for="claveID" class="form-label">Clave</label>
        <input type="text" name="clave" value="<?php echo $clave;?>" class="form-control" id="claveID"
        placeholder="Introduzca clave" >
        <span class="text-danger"> <?php echo $claveErr ?> </span>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-sm-6 p-0">
        <label for="tituloID" class="form-label">Titulo del proyecto</label>
        <input type="text" name="titulo" value="<?php echo $titulo;?>" class="form-control"
        id="tituloID" placeholder="Título del proyecto">
        <span class="text-danger"> <?php echo $tituloErr ?> </span>
    </div>

    <div class="mb-3 pl-2 col-sm-6 p-0">
        <label for="fechaproyect" class="form-label">Fecha del proyecto</label>
        <input type="text" name="fechaproyect" value="<?php echo $fechaproyect;?>" class="form-control"
        id="fechaproyectID" placeholder="Fecha final del proyecto">
        <span class="text-danger"> <?php echo $fechaproyectErr ?> </span>
    </div>
</div>
<!-- Lo siguiente es el campo descripcion-->
<div class="row mb-4">
<label for="areaTexto" class="form-label">Descripción del proyecto</label>
<textarea class="form-control" name="descripcionProyecto" id="areaTexto" rows="3" placeholder="Escriba la descripción del proyecto."><?php print $descripcionProyecto;?>
</textarea>
<span class="text-danger"> <?php echo $descripcionProyectoErr ?> </span>
</div>

<!-- //UD5.4 5.4.c RA6.d Creo el seleccionador multiple que se guardara en categorias[]  -->
<div class="row mb-4">
    <p>Seleccione las categorias del proyecto:</p>
    <select name='categorias[]' multiple size=5>
        <option value=1 >PHP</option>
        <option value=2 >Python</option>
        <option value=3 >Docker</option>
        <option value=4 >MySQL</option>
        <option value=5 >JavaScript</option>
    </select>
</div>


<!-- Esto es la parte del archivo para subir  -->
<div class="row mb-4">
<label for="archivoID" class="form-label">Adjuntar imagen proyecto</label>
<input class="form-control" type="file" id="archivoID" name="archivoProyecto">
</div>
<span class="text-danger"> <?php echo $archivoProyectoErr ?> </span>
<br>


<button type="submit" class="btn btn-success">Enviar</button>
</form>
</div>
</div>

<?php include("templates/footer.php");?>