<?php include("templates/header.php"); ?>


<?php
//importante inicializar todas las variables a vacio. 
    $nameErr = $emailErr = $telefonoErr = $tipoErr = $archivoErr = "";
    $name = $email = $telefono = $tipo = $mensaje = "";
    $pathArchivo = $nombreArchivo = "";
     
     
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["nombreApellidos"])) {
            $nameErr = "Por favor, introduzca nombre y apellidos";
        }else {
            $name = test_input($_POST["nombreApellidos"]);
            //Expresion regular para solo letras y espacios
            if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                $nameErr = "Solo se permiten letras y espacios.";
            }
            }
        if (empty($_POST["email"])) {
            $emailErr = "Por favor, introduzca su e-mail.";
        } else {
                $email = test_input($_POST["email"]);
                if (!preg_match("/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()
                [\]\.,;:\s@\”]{2,})$/",$email)) {
                $emailErr = "Introduzca un e-mail válido.";
            }
        }
        if (empty($_POST["telefono"])) {
            $telefonoErr = "Por favor, introduzca su telefono.";
        } else {
                $telefono = test_input($_POST["telefono"]);
                if (!preg_match("/^[9|6]{1}([\d]{2}[-]*){3}[\d]{2}$/",$telefono)) {
                $telefonoErr = "Introduzca un telefono válido.";
            }
        }
        if (empty($_POST["tipo"])) {
            $tipoErr = "Por favor, introduzca el tipo de consulta.";
            } else {
            $tipo = $_POST["tipo"];
        }
        //Este no confirma si no que solo almacena el campo si da error
        if (!empty($_POST["mensaje"])){
            $mensaje = test_input($_POST["mensaje"]);
        }
        //Esto es lo de subir archivos
        if (!empty($_FILES['archivo'])) {
            $nombreArchivo = $_FILES['archivo']['name'];
            move_uploaded_file($_FILES['archivo']['tmp_name'], "/var/www/html/uploads/{$nombreArchivo}");
            if ($nombreArchivo){
            $pathArchivo = "uploads/{$nombreArchivo}";
            }
            }

        // Introducimos código que repasa todas las variables de error y confirma que esten vacias
        //para luego cfear un array sociativa con los valores de los formularios

        if ($nameErr === "" && $emailErr === "" && $telefonoErr === "" && $tipoErr === "") {
            $contacto = [
            "name" => $name,
            "email" => $email,
            "telefono" => $telefono,
            "tipo" => $tipo,
            "mensaje" => $mensaje,
            "file" => $pathArchivo,
            ];

            //Aqui cargamos el json del archivo en el array temporal .
            $tempArray = json_decode(file_get_contents('mysql/contactos.json'));
        // Hacemos un if que si el array esta vacio lo crea con un array.
            if ($tempArray === NULL){
                     $tempArray = [];
                }
                
                $contacto['id'] = count($tempArray) + 1;
                //Aqui monta el array con el nuevo contacto
            array_push($tempArray, $contacto);
            $contactos_json = json_encode($tempArray);
            //Aqui guarda el nuevo array otra vez en el archivo
            file_put_contents('mysql/contactos.json', $contactos_json);
            
            ?>

            <!-- Si todo es correcto sale del minibucle del php realiza el salto de web a la pagina
        de confirmación y acaba de cerrarlo todo.  -->
        <script type="text/javascript">
        window.location = "/confirma_contacto.php";
        </script>
<?php

        }

    //Esta llave es la del request mode server.
    }
?>


<div class="container">
<h2 class="mb-5">Contacto</h2>
<div class="row">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
<div class="mb-3 col-sm-6 p-0">
    <div class="row">
        <label for="nombreApellidosID" class="form-label">Nombre y apellidos</label>
        <!--Esta linea es para crear el campo. value nos permite mantener el texto en el campo aunque
        sea erroneo y mantenga el texto escrito. Creamos la variable name en php del principio justo antes 
        de la expresion regular  -->
        <input type="text" name="nombreApellidos" value="<?php echo $name;?>" class="form-control" id="nombreApellidosID"
        placeholder="Su nombre y apellidos" >
        <span class="text-danger"> <?php echo $nameErr ?> </span>
    </div>
</div>
<div class="row">
    <div class="mb-3 col-sm-6 p-0">
        <label for="emailID" class="form-label">e-mail</label>
        <input type="text" name="email" value="<?php echo $email;?>" class="form-control"
        id="emailID" placeholder="Su e-mail">
        <span class="text-danger"> <?php echo $emailErr ?> </span>
    </div>

    <div class="mb-3 pl-2 col-sm-6 p-0">
        <label for="telefono" class="form-label">Telefono</label>
        <input type="text" name="telefono" value="<?php echo $telefono;?>" class="form-control"
        id="telefonoID" placeholder="Su telefono">
        <span class="text-danger"> <?php echo $telefonoErr ?> </span>
    </div>
</div>
<!-- Esto son las dos casillas de selccion de empresa o privado.  -->
<div class="row mb-4">
<div class="form-check">
<input class="form-check-input" type="radio" name="tipo" id="particularID" value="particular" <?php if (isset($tipo) && $tipo=="particular") echo "checked";?>>
<label class="form-check-label" for="particularID">
Particular
</label>
</div>
<div class="form-check">
<input class="form-check-input" type="radio" name="tipo" id="empresaID" value="empresa" <?php
if (isset($tipo) && $tipo=="empresa") echo "checked";?>>
<label class="form-check-label" for="empresaID">
Empresa
</label>
</div>
<span class="text-danger"> <?php echo $tipoErr ?> </span>
</div>

<!-- Lo siguiente es el campo descripcion-->
<div class="row mb-4">
<label for="areaTexto" class="form-label">Mensaje</label>
<textarea class="form-control" name="mensaje" id="areaTexto" rows="3" placeholder="Escriba su
mensaje..."><?php print $mensaje;?>
</textarea>

</div>

<!-- Esto es la parte del archivo para subir  -->
<div class="row mb-4">
<label for="archivoID" class="form-label">Adjuntar archivo</label>
<input class="form-control" type="file" id="archivoID" name="archivo">
</div>
<span class="text-danger"> <?php echo $archivoErr ?> </span>
<br>


<button type="submit" class="btn btn-success">Enviar</button>
</form>




</div>
</div>
<?php include("templates/footer.php"); ?>