<?php include_once ("utiles.php");?>
<?php
$email = $password = $nombreapellido = $dni = '';
$emailErr = $passwordErr = $nombreapellidoErr = $dniErr ='';
$cookie_name = "";
$cookie_value = "";

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

/*
//UD4 4.1.b Creo el comprobador de usuario y contraseña comparando con un JSON.
//Si las variables de error estan vacias crea el array loger con el email y el pass introducidos.
if ($emailErr === "" && $passwordErr === "") {
            $loger = [
            "email" => $email,
            "password" => $password,
            ];

            //Aqui cargamos el json del archivo en la variable array temporal .
            $tempArray = json_decode(file_get_contents('mysql/usuario.json'), true);
            //Esto es por si el json está vacio NULL que cree un array vacio. 
            if ($tempArray === NULL){
                $tempArray = [];
           }
           //Aqui hacemos la comparativa con un foreach del array creado con el json.
           // 4.1.c Cada user lo comprobamos con el email recibido y comprobamos el pass tambien. 
           foreach ($tempArray as $user){
            if($user["email"]===$loger["email"]){ 
                if($user["password"]===$loger["password"]){
                    // RA4.c 4.1.e Si todo es correcto creamos la cookie con el valor del email
                    // y luego saltamos a la nueva web
                    setcookie("user_email", $loger["email"], time()+(86400*30), "/");
                    ?>
                <script type="text/javascript">
                     window.location = "/contacto_lista.php";
                </script>
                <?php

                //UD4 4.1.d aquí si el password no es correcto hacemos salir el error rojo
                // y ponemos el break para salir del buble y que no salga el error rojo 
                // con los siguientes users del array. 
                }else{
                    $passwordErr = "El password introducido es erroneo.";
                    break;
                }
                
                // UD4 4.1.d Aquí comprobamos si está la etiqueta vacia para 
                //evitar el salte el error al estar vacio.
            } elseif($loger["email"]==''){
                $emailErr = '';
               // UD4 4.1.d Y aquí damos el error si no es está correcto y no está vacio. 
            }else{
                $emailErr = "El usuario introducido es erroneo.";
                 }
            //Esta es la llave del foreach
           }
//Esta es la llave del if principal de los errores. 
}
*/
    ?>
    

<?php include("templates/header.php"); 
?>


<div class="container">
    <h2 class="mb-5">Usuario</h2>
    <div class="row">
        <!--//UD4.3 RA3.e  4.3.b creo el formulario con todas las restricciones.  -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="emailID" class="form-label">Email</label>
                    <input type="text" name="email" value="<?php echo $email;?>" class="form-control" id="emailID"
                    placeholder="Introduzca su email" >
                    <span class="text-danger"> <?php echo $emailErr ?> </span>
                </div>
            </div>
            
            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="nombreapellidoID" class="form-label">Nombre y apellidos</label>
                    <input type="text" name="nombreapellido" value="<?php echo $nombreapellido;?>" class="form-control" id="nombreapellidoID"
                    placeholder="Introduzca su nombre y sus dos apellidos" >
                    <span class="text-danger"> <?php echo $nombreapellidoErr ?> </span>
                </div>
            </div>

            <div class="mb-3 col-sm-6 p-0">
                <div class="row">
                    <label for="dniID" class="form-label">DNI</label>
                    <input type="text" name="dni" value="<?php echo $dni;?>" class="form-control" id="dniID"
                    placeholder="Introduzca su DNI completo" >
                    <span class="text-danger"> <?php echo $dniErr ?> </span>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-sm-6 p-0">
                    <label for="passwordID" class="form-label">Password</label>
                    <input type="password" name="password" value="<?php echo $password;?>" class="form-control"
                    id="passwordID" placeholder="Su password">
                    <span class="text-danger"> <?php echo $passwordErr ?> </span>
                </div>
            </div>
        <br>
        <button type="submit" class="btn btn-success">Enviar</button>
        </form>

    </div>

</div>
<?php include("templates/footer.php"); ?>