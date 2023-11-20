<?php include_once ("utiles.php");
include_once ("mysql/usuario_sql.php");
include_once ("mysql/sesion_sql.php");
include_once("mysql/db_access.php");
?>
<?php
$email = $password = '';
$emailErr = $passwordErr = '';
$session_name = "";
$session_value = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if (empty($_POST["email"])) {
        $emailErr = "Por favor, introduzca su e-mail.";
    } else {
            $email = test_input($_POST["email"]);
            //Expresion regular para chequear ue lo introducido sea un email.
            if (!preg_match("/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()
            [\]\.,;:\s@\”]{2,})$/",$email)) {
            $emailErr = "Introduzca un e-mail válido.";
        }
    }
    


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


$conn=open_connection();

//UD4 4.1.b Creo el comprobador de usuario y contraseña
//Si las variables de error estan vacias crea el array loger con el email y el pass introducidos.
if ($emailErr === "" && $passwordErr === "") {
    $loger = [
    "email" => $email,
    "password" => $password,
    ];
  
    if(!empty($loger["email"])&$loger["email"]!==''){
  //Aquí creo dos variables con el return de las funciones que buscan password y email en la base de datos con el email.   
   $confirmuser = get_existe_usuario($conn, $loger["email"]);     
   $confirmpass = get_credenciales_usuario($conn, $loger["email"]);
   
    //El primer if es para confirmar que el email existe en la BD. En caso q no devuelve un mensaje en la casilla de email. 
    if($confirmuser==$loger["email"]){
        //Segundo if donde confirmamos que el password introducido es el mismo que el que nos ha devuelto la BD con la fuinción. En caso que no devuelve un mensaje en la casilla de password
        if($confirmpass==$loger["password"]){
            //Aqui creo la cookie, le doy valor y tiempo de existencia de 30 días.  
            setcookie("user_email", $loger["email"], time()+(86400*30), "/");
            //UD5.5 5.5.a RA6.e Primero me guardo en variable la id del usuario y luego con new season y la id creo sesion en la BD
            $id_usuario=get_id_usuario($conn, $loger["email"]);
            new_sesion($conn,$id_usuario);
            
            
            ?>
        <!--Aqui saltamos al a pagina contacto_lista.php -->
        <script type="text/javascript">
             window.location = "/contacto_lista.php";
        </script>
        
        <?php
        
     
        }else{
            $passwordErr = "La contraseña introducida es erronea.";
            }
    
     
    }else{
        $emailErr = "El usario introducido es erroneo.";
        }

}}

    ?>
<?php include("templates/header.php"); 
echo $id_usuario;
?>
<!-- UD4 4.1 Monto la página login.php 
creo las variables para almacenar los datos,
 luego los confirmadores tanto del campo vacio en el post
como de los datos correctos con las expresiones regulares.
Y muy importante los meto en los campos post creados -->
<!-- UD4 4.1 Aquí creo los formularios y el boton de enviar.
Con PHP hago que se repita el texto introducido en caso de error.
Y en caso de error sale en texto rojo el mensaje de error. -->




<div class="container">
    <h2 class="mb-5">Login</h2>
    <div class="row">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="emailID" class="form-label">Email</label>
                    <input type="text" name="email" value="<?php echo $email;?>" class="form-control" id="emailID"
                    placeholder="Introduzca su email" >
                    <!-- UD4 4.1.d La etiqueta de aviso de errores usuario -->
                    <span class="text-danger"> <?php echo $emailErr ?> </span>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-sm-6 p-0">
                    <label for="passwordID" class="form-label">Password</label>
                    <input type="password" name="password" value="<?php echo $password;?>" class="form-control"
                    id="passwordID" placeholder="Su password">
                    <!-- UD4 4.1.d La etiqueta de aviso de errores password -->
                    <span class="text-danger"> <?php echo $passwordErr ?> </span>
                </div>
            </div>
        <br>
        <button type="submit" class="btn btn-success">Enviar</button>
        </form>

    </div>

</div>
<?php include("templates/footer.php"); ?>
<?php //UD5.2 5.2.1 RA6.b llamo a la función cerrar conexión y le doy los datos de la conexión y esta procede a cerrar la conn.
close_connection($conn); ?>