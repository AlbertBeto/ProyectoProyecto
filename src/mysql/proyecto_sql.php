<?php include_once("db_access.php");

function get_proyectos_all($conn){
    $proyecto_select_all = "SELECT * FROM proyecto";
    $consulta = $conn->prepare($proyecto_select_all);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

function get_proyecto_detail($conn, $proyecto_id){
    $proyecto_select_all = "SELECT * FROM proyecto WHERE id = :proy_id";
    $consulta = $conn->prepare($proyecto_select_all);
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindParam(":proy_id", $proyecto_id);
    $isOk = $consulta->execute();

    if ($consulta -> rowCount() == 0){
        trigger_error("No se ha encontrado el ID de proyecto");
    }
    if ($consulta -> rowCount() > 1){
        trigger_error("Se ha recuperado más de un registro");
    }
    
    return $consulta->fetch();
}

//UD5.3 5.3.c RA6.c Creo una función que devuelva proyectos segun categoria.
function get_proyectos_por_categoria($conn, $cat){
    $proyecto_por_categoria = "SELECT pr.* FROM proyecto pr JOIN categoria_proyecto cp ON pr.id = cp.proyecto_id WHERE cp.categoria_id=$cat";
    $consulta = $conn->prepare($proyecto_por_categoria);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

//UD5.3 5.3.d RA6.d y //UD5.4 5.4.b Creo una función que ordena el listado de proyectos según ascendente o descendente y según por lo que queramos ordenar. 
function get_proyectos_order_by($conn,$param){
    //Cojo los 3 últimos caracteres de param que son los parametros de la url y segun el valor
    //se lo doy a way. 
    $preway=substr($param,3,3);
    $way=null;
    $preway=="des" ? $way="desc":$way="asc";
    //Cojo los 3 primeros caracteres de param que son los parametros de la url y segun el valor
    //le doy un valor a ordenador. 
    $preordenador=substr($param,0,3);
    $ordenador="titulo";
    if(!is_null($preordenador)){
        if($preordenador=="nom"){$ordenador="titulo";}elseif($preordenador=="fec"){$ordenador="fecha";};
    }
    // Monto el sql ordenado por ordenador y way. 
    $proyecto_ordenado_por = "SELECT * FROM proyecto ORDER BY $ordenador $way";
    $consulta = $conn->prepare($proyecto_ordenado_por);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

//UD5.3 5.3.d RA6.d y //UD5.4 5.4.b Creo una función que ordena el listado de proyectos según ascendente o descendente y según por lo que queramos ordenar. 
//Y mantiene la selección de categorias. 
function get_proyectos_por_categoria_ordenado($conn, $cat, $param){
    //Cojo los 3 últimos caracteres de param que son los parametros de la url y segun el valor
    //se lo doy a way. 
    $preway=substr($param,3,3);
    $way=null;
    $preway=="des" ? $way="desc":$way="asc";
    //Cojo los 3 primeros caracteres de param que son los parametros de la url y segun el valor
    //le doy un valor a ordenador. 
    $preordenador=substr($param,0,3);
    $ordenador='titulo';
    if(!is_null($preordenador)){
        if($preordenador=="nom"){$ordenador="titulo";}elseif($preordenador=="fec"){$ordenador="fecha";};
    }
    // Monto el sql reducido a categoria ordenado por ordenador y way 
    $proyecto_por_categoria = "SELECT pr.* FROM proyecto pr JOIN categoria_proyecto cp ON pr.id = cp.proyecto_id WHERE cp.categoria_id=$cat ORDER BY $ordenador $way";
    $consulta = $conn->prepare($proyecto_por_categoria);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

//UD5.5 5.5.b RA6.e Esta es la funcion para crear proyectos en la tabla proyectos.
function new_proyecto($conn,$neoProyecto){
        $clave = $neoProyecto["clave"];
        $titulo = $neoProyecto["titulo"];
        $descripcionProyecto = $neoProyecto["descripcion"];
        $pathArchivo = $neoProyecto["imagen"];
        $fechaproyect = $neoProyecto["fecha"];
    //Aqui monto el query diciendole qué y donde tiene que meter los datos en la tabla proyecto. 
    $nuevo_proyecto = "INSERT INTO proyecto (clave, titulo, fecha, descripcion, imagen) VALUES ('$clave', '$titulo', '$fechaproyect', '$descripcionProyecto', '$pathArchivo')";
    $consulta = $conn->prepare($nuevo_proyecto);
    $isOK = $consulta->execute();
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
}

//UD5.6 5.6.c RA6.f Creo función para modificar los campos de la tabla proyecto 
function update_proyecto($conn, $neoProyecto){
    //Para evitar errores paso los datos del usuario a variables internas de la función.     
    $clave = $neoProyecto["clave"];
    $titulo = $neoProyecto["titulo"];
    $descripcionProyecto = $neoProyecto["descripcion"];
    $pathArchivo = $neoProyecto["imagen"];
    $fechaproyect = $neoProyecto["fecha"];
    $id_old = $neoProyecto["id"];

    
    //Escribo el query para modificar los campos de la tabla usuario usando los datos del nuevo usuario. 
    $update_proyecto = "UPDATE proyecto SET clave=:clave, titulo=:titulo, fecha=:fechaproyect, descripcion=:descripcionProyecto, imagen=:pathArchivo WHERE id=:id_old";
    $consulta = $conn->prepare($update_proyecto);

    $consulta->bindParam(':clave', $clave);
    $consulta->bindParam(':titulo', $titulo);
    $consulta->bindParam(':fechaproyect', $fechaproyect);
    $consulta->bindParam(':descripcionProyecto', $descripcionProyecto);
    $consulta->bindParam(':pathArchivo', $pathArchivo);
    $consulta->bindParam(':id_old', $id_old);

    $isOK = $consulta->execute();
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);



}

?>