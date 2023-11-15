<?php include_once("db_access.php");

?>

<?php
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

//UD5.3 5.3.d RA6.c Creo una función que ordena el listado de proyectos según ascendente o descendente y según por lo que queramos ordenar. 
function get_proyectos_order_by($conn, $way, $ordenador){
    if($way=="ascendente"){
        $neoway="ASC";
    }else if($way=="descendente"){
        $neoway="DES";
    };
    $proyecto_ordenado_por = "SELECT * FROM proyecto order by $ordenador $neoway";
    $consulta = $conn->prepare($proyecto_ordenado_por);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

?>