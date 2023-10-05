<?php include("templates/header.php"); ?>


<?php
    $nameErr = "";
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
    }
?>

<div class="container">
<h2 class="mb-5">Contacto</h2>
<div class="row">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
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

<button type="submit" class="btn btn-success">Enviar</button>
</form>



</div>
</div>
<?php include("templates/footer.php"); ?>