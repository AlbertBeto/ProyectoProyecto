<?php 
include_once ("mysql/sesion_sql.php");
include_once("mysql/db_access.php");
include_once ("mysql/usuario_sql.php");
$conn=open_connection();
//UD5.5 5.5.b RA6.e Recupero el valor de la cookie y se lo paso a la función borrar sesion. 
$email_sesion_borrar = $_COOKIE["user_email"];
delete_sesion($conn,$email_sesion_borrar);
//RA4.c 4.1.f Al entrar en la web destruimos la cookie y saltamos a index.php
setcookie("user_email",0, time()-3600); 
//Procedo a cambiar el sistema a uso de cookies de sesión
close_connection($conn);
?>

<script type="text/javascript">
                     window.location = "/index.php";
                </script>