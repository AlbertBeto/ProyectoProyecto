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
    }
?>

<div class="container">
<h2 class="mb-5">Contacto</h2>
<div class="row">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="mb-3 col-sm-6 p-0">
<label for="nombreApellidosID" class="form-label">Nombre y apellidos</label>
<!--Esta linea es para crear el campo. value nos permite mantener el texto en el campo aunque
sea erroneo y mantenga el texto escrito. Creamos la variable name en php del principio justo antes 
de la expresion regular  -->>
<input type="text" name="nombreApellidos" value="<?php echo $name;?>" class="form-control" id="nombreApellidosID"
placeholder="Su nombre y apellidos" >
<span class="text-danger"> <?php echo $nameErr ?> </span>
</div>
<button type="submit" class="btn btn-success">Enviar</button>
</form>



</div>
</div>
<?php include("templates/footer.php"); ?>