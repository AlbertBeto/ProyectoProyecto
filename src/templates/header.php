<?php include_once("utiles.php");
include_once("categoria_sql.php");
include_once("mysql/db_access.php");
$conn=open_connection();

/*
if(!isset($_COOKIE["user_email"])){
setcookie("user_email",1, time()+(86400*30), "/"); 
}*/

?>
<!DOCTYPE html>
<html>
<!--UD3.5.a Incluyo en el header, que es lo primero que se monta el include utiles.php y lo quito de index que es lo que se monta a continuación.-->
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
                <a href="index.php" 
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
        <!-- UD5.4 5.4.a Utilizo en el foreach del desplegable la función para sacar todas las categorias. -->   
                <?php foreach (get_categorias_all($conn) as $cat){  ?>
                    <a class="dropdown-item" href="#">
                        <?php echo $cat['nombre'] ?>
                    </a>
                        <?php } ?>                
                </div>
            </li>

            <li class="nav-item">
            <a href="sobre_mi.php" 
                    class="nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="/sobre_mi.php") { echo "active";}?> 
                        " 
                        >SOBRE MÍ
                </a>
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

            <!-- RA4.c 4.1.f Si la cookie existe es visible-->
            <?php  if (isset($_COOKIE["user_email"])) { ?>
            <li class='nav-item'>
                <!-- UD4.3 RA3.e 4.3.a Creo el desplegable en administración manteniendo que solo aparezca logeado.   -->
                <a href='contacto_lista.php' 
                class="nav-link dropdown-toggle" id="dropdownMenu1" data-bs-toggle="dropdown" aria-haspopup="true">
                        ADMINISTRACIÓN
                        <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="dropdown-item" href="/contacto_lista.php">Lista de contactos</a>
                    <a class="dropdown-item" href="/usuario.php">Usuario</a>
                </div>
            </li> 
            <?php } ?>

            <!-- RA4.c 4.1.f Si la cookie no existe es visible-->
            <?php  if (!isset($_COOKIE["user_email"])) { ?>     
                <li class='nav-item'>
                <a href='login.php' 
                        class="nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="/login.php") { echo "active";}?>
                        "
                        >LOG IN
                </a>
            </li> 
            <?php } ?>
            <!-- RA4.c 4.1.f Si la cookie existe es visible-->
            <?php  if (isset($_COOKIE["user_email"])) { ?>
            <li class='nav-item'>
                <!-- 4.1.a Creo boton y lo direccion a la pagina login.php  -->
                <a href="logout.php"
                        class='nav-link
                        <?php if($_SERVER['SCRIPT_NAME']=="/login.php") { echo "active";}?>
                        ' 
                        >LOG OUT
                </a>
            </li> 
            <?php }
            close_connection($conn);
            ?>

        </ul>
    </header>