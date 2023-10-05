<?php include("templates/header.php"); ?>


<?php
    $nameErr = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["nombreApellidos"])) {
            $nameErr = "Por favor, introduzca nombre y apellidos";
        }
    }
?>

<div class="container">
<h2 class="mb-5">Contacto</h2>
<div class="row">

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="mb-3 col-sm-6 p-0">
<label for="nombreApellidosID" class="form-label">Nombre y apellidos</label>
<input type="text" name="nombreApellidos" class="form-control" id="nombreApellidosID"
placeholder="Su nombre y apellidos" >
<span class="text-danger"> <?php echo $nameErr ?> </span>
</div>
<button type="submit" class="btn btn-success">Enviar</button>
</form>



</div>
</div>
<?php include("templates/footer.php"); ?>