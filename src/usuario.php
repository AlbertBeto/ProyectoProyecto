<?php include_once ("utiles.php");
include_once ("mysql/sesion_sql.php");
include_once("mysql/db_access.php");
include_once ("mysql/usuario_sql.php");
// UD4.3 RA4.a 4.3.4.a Decido usar las cookies de sesion ya que aportan más seguridad al gestionar los datos desde el servidor, evitar que 
//un usuario modifiue los datos de la cookie persistente o cierre el navegador sin desloguear y sobre todo con la gestión de los datos del usuario
// aunque den mas carga de recursos en el sevidor. 
?>

<?php
$email = $password = $nombreapellido = $dni = '';
$emailErr = $passwordErr = $nombreapellidoErr = $dniErr = $passwordErr ='';
$posicion = "";
$session_value = "";

$conn=open_connection();



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //UD4.3 RA3.e  4.3.b creo el formulario con todas las restricciones. 
    if (empty($_POST["email"])) {
        $emailErr = "Por favor, introduzca su e-mail.";
    } else {
            $email = test_input($_POST["email"]);
            //Expresion regular para chequear que lo introducido sea un email.
            if (!preg_match("/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()
            [\]\.,;:\s@\”]{2,})$/",$email)) {
            $emailErr = "Introduzca un e-mail válido.";
        }
    }
    
    if (empty($_POST["nombreapellido"])) {
        $nombreapellidoErr = "Por favor, introduzca su nombre y su apellido.";
    } else {
            $nombreapellido = test_input($_POST["nombreapellido"]);
            // Lo limito a 3 como minimo y 4 maximo para aceptar nombres bicompuestos, los apellidos compuestos y nombres multicompuestos que lo apreten
            if (!preg_match("/^[a-zA-Z]+(?: [a-zA-Z]+){2,3}$/",$nombreapellido)) {
            $nombreapellidoErr = "Nombre y dos apellidos";
        }
    };

    if (empty($_POST["dni"])) {
        $dniErr = "Por favor, introduzca su DNI.";
    } else {
            $dni = test_input($_POST["dni"]);
            if (!preg_match("/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i",$dni)) {
            $dniErr = "Introduzca su DNI";
        }
    };

    if (empty($_POST["password"])) {
        $passwordErr = "Por favor, introduzca password.";
    }else {
        $password = test_input($_POST["password"]);
        //Expresion regular para password minimo 8 caracteres y al menos un número y una letra.
        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',$password)) {
            $passwordErr = "Error. Minimo 8 caracteres con al menos una letra y un número.";
        }
        }
}

if ($emailErr === "" && $passwordErr === "" && $nombreapellidoErr === "" && $dniErr === "") {

    $neoUser = [
        "email" => $email,
        "nombreapellido" => $nombreapellido,
        "dni" => $dni,
        "password" => $password
    ];
    ///UD5.6 5.6.f RA6.f Aquí compruebo que si se ha enviado el submit a esta misma pagina y despues de la comprobación de errores
    // y la construcción de neoUser activo la función de updatear el usuario.  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        update_usuario($conn,$neoUser);
    }

}

    ?>
<?php include("templates/header.php"); 
// UD4.3 RA4.c 4.3.4.c Aquí recuperamos la variable se la sesion
// UD4.3 RA4.f 4.3.4.f almacenamos su posición dentro del array de usuarios que tenemos en datos.php
$session_value = $_COOKIE["user_email"];   

$usuario=get_usuario_completo($conn, $session_value);

?>
<div class="container">
    <h2 class="mb-5">Usuario</h2>
    <div class="row">
        <!--//UD4.3 RA3.e  4.3.b creo el formulario con todas las restricciones.  -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="emailID" class="form-label">Email</label>
                    <!--  UD4.3 RA4.f 4.3.4.f  en el value del input de este y de los demas usamos la posición almacenada para cargar la info del array usuarios de datos.php-->
                    <input type="text" name="email" value="<?php echo $usuario[0]["email"];?>" class="form-control" id="emailID"
                    placeholder="Introduzca su email" >
                    <span class="text-danger"> <?php echo $emailErr ?> </span>
                </div>
            </div>
            
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="nombreapellidoID" class="form-label">Nombre y apellidos</label>
                    <input type="text" name="nombreapellido" value="<?php echo $usuario[0]["NombreApellidos"];?>" class="form-control" id="nombreapellidoID"
                    placeholder="Introduzca su nombre y sus dos apellidos" >
                    <span class="text-danger"> <?php echo $nombreapellidoErr ?> </span>
                </div>
            </div>

            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="dniID" class="form-label">DNI</label>
                    <input type="text" name="dni" value="<?php echo $usuario[0]["DNI"];?>" class="form-control" id="dniID"
                    placeholder="Introduzca su DNI completo" >
                    <span class="text-danger"> <?php echo $dniErr ?> </span>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-sm-6 p-0">
                    <label for="passwordID" class="form-label">Password</label>
                    <input type="password" name="password" value="<?php echo $usuario[0]["passwordW"];?>" class="form-control"
                    id="passwordID" placeholder="Su password">
                    <span class="text-danger"> <?php echo $passwordErr ?> </span>
                </div>
            </div>
        <br>
         <!--//UD5.6 RA6.f  5.6.d El boton de enviar el formulario solo está activo si el usuario es admin.   -->
        <?php if(get_user_logged_in()){ ?>
        <button type="submit" class="btn btn-success">Enviar</button> <?php }; ?>
        </form>

    </div>

</div>
<?php include("templates/footer.php"); 
close_connection($conn);?>