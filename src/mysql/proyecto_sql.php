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
    $proyecto_por_categoria = "SELECT proyecto_id FROM categoria_proyecto WHERE categoria_id=$cat";
    $consulta = $conn->prepare($proyecto_por_categoria);
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $isOK = $consulta->execute();
    return $consulta->fetchAll();
}

?>