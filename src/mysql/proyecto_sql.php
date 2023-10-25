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
?>