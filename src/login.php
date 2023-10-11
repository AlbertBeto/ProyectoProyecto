<?php include("templates/header.php"); ?>
<!-- UD4 4.1.a Monto la página login.php 
creo las variables para almacenar los datos,
 luego los confirmadores tanto del campo vacio en el post
como de los datos correctos con las expresiones regulares.
Y muy importante los meto en los campos post creados -->
<?php
$email = $password = '';
$emailErr = $passwordErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Por favor, introduzca su e-mail.";
    } else {
            $email = test_input($_POST["email"]);
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



if ($emailErr === "" && $passwordErr === "") {
            $loger = [
            "email" => $email,
            "password" => $password,
            ];

            //Aqui cargamos el json del archivo en el array temporal .
            $tempArray = json_decode(file_get_contents('mysql/usuario.json'), true);

            if ($tempArray === NULL){
                $tempArray = [];
           }
           
           foreach ($tempArray as $user){
            if($user["email"]==$loger[$email] && $user["password"]==$loger[$password]){ ?>
                <script type="text/javascript">
                     window.location = "/contacto_lista.php";
                </script>
                <?php
            }
           }

        }
            ?>


<!-- UD4 4.1.a Aquí creo los formularios y el boton de enviar.
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
                    <span class="text-danger"> <?php echo $emailErr ?> </span>
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