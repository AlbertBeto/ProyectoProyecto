<?php
include_once("utiles.php");
include_once("mysql/proyecto_sql.php");
include_once("mysql/categoria_sql.php");
include_once("mysql/db_access.php");

//importante inicializar todas las variables a vacio. 
$claveErr = $tituloErr = $fechaproyectErr = $descripcionProyectoErr = $archivoProyectoErr = "";
$clave = $titulo = $fechaproyect = $descripcionProyecto = "";
$pathArchivo = $nombreArchivo = "";
$posicion = "";
$proyectop2 = $_GET["id"];
$conn = open_connection();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["clave"])) {
        $claveErr = "Por favor, introduzca una clave correcta.";
    } else {
        $clave = test_input($_POST["clave"]);
        //Expresion regular para solo letras y espacios
        if (!preg_match("/^\S+$/", $clave)) {
            $claveErr = "Obligatorio. No se permiten espacios.";
        }
    };
    if (empty($_POST["titulo"])) {
        $tituloErr = "Por favor, introduzca el título del proyecto.";
    } else {
        $titulo = test_input($_POST["titulo"]);
        if (preg_match("/^.{31,}$/", $titulo)) {
            $tituloErr = "Máximo 30 caracteres.";
        }
    };
    if (empty($_POST["fechaproyect"])) {
        $fechaproyectErr = "Por favor, introduzca fecha de finalización.";
    } else {
        $fechaproyect = test_input($_POST["fechaproyect"]);
        if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/(19|20)\d{2}$/", $fechaproyect)) {
            $fechaproyectErr = "Introduzca un fecha válida.";
        }
    };
    if (empty($_POST["descripcionProyecto"])) {
        $descripcionProyectoErr = "Por favor, introduzca descripción del proyecto.";
    } else {
        $descripcionProyecto = test_input($_POST["descripcionProyecto"]);
        if (preg_match("/^.{251,}$/", $descripcionProyecto)) {
            $descripcionProyectoErr = "Máximo 250 caracteres.";
        }
    };
    //Esto es lo de subir archivos
    if (!empty($_FILES['archivo'])) {
        $nombreArchivo = $_FILES['archivo']['name'];
        move_uploaded_file($_FILES['archivo']['tmp_name'], "/var/www/html/uploads/{$nombreArchivo}");
        if ($nombreArchivo) {
            $pathArchivo = "uploads/{$nombreArchivo}";
        }
    };

    // Repasa todas las variables de error y confirma que esten vacias
    //para luego crear un array con los valores de los formularios en el orden del array

    if ($claveErr === "" && $tituloErr === "" && $fechaproyectErr === "" && $descripcionProyectoErr === "") {

        $neoproyecto = [

            "id" => $proyectop2,
            "clave" => $clave,
            "titulo" => $titulo,
            "descripcion" => $descripcionProyecto,
            "imagen" => $pathArchivo,
            "fecha" => $fechaproyect,
        ];


        //UD5.6 5.6.c RA6.e Aqui tras confirmar que no hay errores recogemos la info de todos los inputs
        // Y que se ha lanzado el formulario llamamos a la función que inserta el nuevo proyecto en la tabla proyecto

        update_proyecto($conn, $neoproyecto);
        //Utilizo un header de php ya que he tenido muchos problemas con el script y los parametros.  
        header("Location: /confirma_proyecto.php?id=" . $proyectop2);
        exit();
    }
}

//UD5.6 5.6.b RA6.f Fuera del primer request method creo el segundo con el añadido que tiene que haber un $_POST de nombre borrar_proyecto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrar_proyecto'])) {
    //Guardo en variable el valor del post.
    $proyecto_id = $_POST['proyecto_id'];
    //Llamo a la variable borrar proyecto y le paso el id a borrar con la variable anterior. 
        delete_proyecto($conn, $proyecto_id);
    // Despues de implementar la variable cargo la página index con parametro de borrado. 
    header("Location: index.php?borrado=true");
    exit();
}

if (isset($_COOKIE["user_email"])) {
    $proyectop = $_GET["id"];
    $posicion = get_proyecto_detail($conn, $proyectop);
    $categorias_proyecto = get_categorias_por_proyecto($conn, $proyectop);
}
include("templates/header.php");
?>
<div class="container">
    <h2 class="mb-5">Formulario Proyectos</h2>
    <div class="row">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $proyectop; ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="claveID" class="form-label">Clave</label>
                    <input type="text" name="clave" value="<?php echo $posicion["clave"]; ?>" class="form-control" id="claveID" placeholder="Introduzca clave">
                    <span class="text-danger"> <?php echo $claveErr ?> </span>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-sm-6 p-0">
                    <label for="tituloID" class="form-label">Titulo del proyecto</label>
                    <input type="text" name="titulo" value="<?php echo $posicion["titulo"]; ?>" class="form-control" id="tituloID" placeholder="Título del proyecto">
                    <span class="text-danger"> <?php echo $tituloErr ?> </span>
                </div>

                <div class="mb-3 pl-2 col-sm-6 p-0">
                    <label for="fechaproyect" class="form-label">Fecha del proyecto</label>
                    <input type="text" name="fechaproyect" class="form-control" id="fechaproyectID" placeholder="Fecha final del proyecto" value="<?php echo $posicion['fecha']; ?>">
                    <span class="text-danger"> <?php echo $fechaproyectErr ?> </span>
                </div>
            </div>
            <!-- Lo siguiente es el campo descripcion-->
            <div class="row mb-4">
                <label for="areaTexto" class="form-label">Descripción del proyecto</label>
                <textarea class="form-control" name="descripcionProyecto" id="areaTexto" rows="3" placeholder="Escriba la descripción del proyecto."><?php print $descripcionProyecto; ?>
                    <?php echo $posicion["descripcion"]; ?>
                </textarea>
                <span class="text-danger"> <?php echo $descripcionProyectoErr ?> </span>
            </div>
            <!-- //UD5.4 5.4.c RA6.d Creo el seleccionador multiple que se guardara en categorias[]  -->
            <div class="row mb-4">
                <select name='categorias[]' multiple size=5>
                    <option value=1 <?php if (in_array('1', $categorias_proyecto)) echo 'selected'; ?>>PHP</option>
                    <option value=2 <?php if (in_array('2', $categorias_proyecto)) echo 'selected'; ?>>Python</option>
                    <option value=3 <?php if (in_array('3', $categorias_proyecto)) echo 'selected'; ?>>Docker</option>
                    <option value=4 <?php if (in_array('4', $categorias_proyecto)) echo 'selected'; ?>>MySQL</option>
                    <option value=5 <?php if (in_array('5', $categorias_proyecto)) echo 'selected'; ?>>JavaScript</option>
                </select>
                <?php


                //UD5.4 5.4.e RA6.d Aqui mostramos las categorias ya seleccionadas en el proyecto. 
                echo "Tiene previamente seleccionado:<br/>";
                // Comprueba si el array del proyecto está vacio. 
                if (!empty($categorias_proyecto)) {
                    //Recorre el array de categorias del proyecto e imprime el nombre de cada categoria. 
                    foreach ($categorias_proyecto as $categoria) {
                        echo "- Categoria: " . $categoria['nombre'] . "<br/>";
                    }
                } else {
                    echo "No tenia ninguna opción seleccionada";
                };

                ?>
            </div>

            <!-- Esto es la parte del archivo para subir  -->
            <div class="row mb-4">
                <p>Ruta de la imagen adjunta al proyecto: <?php echo (!is_null($posicion["imagen"]) ? $posicion["imagen"] : "Sin imagen adjunta."); ?></p>
                <label for="archivoID" class="form-label">Adjuntar imagen proyecto</label>
                <input class="form-control" type="file" id="archivoID" name="archivoProyecto">
            </div>
            <span class="text-danger"> <?php echo $archivoProyectoErr ?> </span>
            <br>


            <button type="submit" class="btn btn-success">Enviar</button>
        </form>
    </div>
</div>
<div>
    <!--UD5.6 5.6.b RA6.f Usando get_user_logged_in solo aparece el boton de borrar proyectos para los admin. -->
    <?php if (get_user_logged_in()) { ?>
        <!--UD5.6 5.6.b RA6.f Aquí especifico que cuando submieto el formulario sea sobre si mismo y que se lleve la id y que sea en metodo post.  -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id=<?php echo $proyectop; ?>" method="POST">
        <!--UD5.6 5.6.b RA6.f En el input le doy valor a proyecto_id con la variable $proyectop -->
            <input type="hidden" name="proyecto_id" value="<?php echo $proyectop; ?>">
            <!--UD5.6 5.6.b RA6.f Envio todo el formulario con con el nombre borrar_proyecto -->
            <button type="submit" name="borrar_proyecto">Borrar proyecto</button>
        </form>
    <?php } ?>
</div>

<?php
include("templates/footer.php");
close_connection($conn);
?>