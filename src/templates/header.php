<!DOCTYPE html>
<html>
<!--UD3.5.a Incluyo en el header, que es lo primero que se monta el include utiles.php y lo quito de index que es lo que se monta a continuación.-->
<?php include("datos.php");include("utiles.php");?>
<head>
    <title>Portfolio de proyectos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css" integrity="sha384-qF/QmIAj5ZaYFAeQcrQ6bfVMAh4zZlrGwTPY7T/M+iTTLJqJBJjwwnsE5Y0mV7QK" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<!-- https://radu.link/make-footer-stay-bottom-page-bootstrap/ -->
<body class="d-flex flex-column min-vh-100">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <!-- UD3.5.a Concateno Portfolio con una funcion creada para sacar el año.  -->
            <span class="fs-4">Portfolio <?php echo anyoActual() ?></span>
        </a>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <!-- UD3.2.a Modifico el href para enlazarlo con la pagina Inicio que es index.php -->
                <a href="index.php?sort=-1" 
                    class="nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="/index.php") { echo "active";}?> 
                        " 
                        >INICIO
                </a>
            </li>
            <!-- UD3.3.e Sustituyo el texto y creo un boton desplegable de las categorias del array $categoriasMain -->
            <li class="nav-item" >
                <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true">
                    CATEGORÍAS
                <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <!-- UD3.3.e Monto un foreach que recorre el array $categoriasMain y crea un link dentro del desplegable por cada campo -->   
                <?php foreach ($categoriasMain as $cat){  ?>
                    <a class="dropdown-item" href="#">
                        <?php echo $cat ?>
                    </a>
                        <?php } ?>                
                </div>
            </li>
            <li class="nav-item">
                <!-- UD3.2.b Modifico el href para enlazarlo con la pagina Inicio que es contacto.php -->
            <a href="contacto.php" 
                    class="nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="/contacto.php") { echo "active";}?> 
                        " 
                        >CONTACTO
                </a>
            </li>

            <!-- 3.2.e Incluyo un IF en PHP que confirme el valor de loggedIn para poner un boton mas Admin -->
            <?php  if ($loggedIn===True) { ?>
            <li class='nav-item'>
                <!-- UD3.2.e Lo tengo en # ya que todavia no va a ninguna parte. Y dejo adminXXXXX para el activo del boton.  -->
                <a href='#' 
                        class='nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="adminXXXXX") { echo "active";}?>
                        ' 
                        >ADMINISTRACIÓN
                </a>
            </li> 
            <?php } ?>

        </ul>
    </header>