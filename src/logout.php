<?php 
//RA4.c 4.1.f Al entrar en la web destruimos la cookie y saltamos a index.php
setcookie("user_email",0, time()-3600); 
//Procedo a cambiar el sistema a uso de cookies de sesión

?>

<script type="text/javascript">
                     window.location = "/index.php";
                </script>