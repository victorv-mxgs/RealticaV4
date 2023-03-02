<?php
if (isset($_POST)) {
    $serv = $_POST['serv'];

    require("conexion.php");
    
    
    if (empty($_POST['servicioTipoId']) && (!empty($_POST['serv']))){
        $query = $pdo->prepare("INSERT INTO serviciotipo (cServicio) VALUES (:serv)");
        $query->bindParam(":serv", $serv);
        $query->execute();
        $pdo = null;
        echo "ok";
    }
    else{
        $servicioTipoId = $_POST['servicioTipoId'];
        $query = $pdo->prepare("UPDATE serviciotipo SET cServicio = :serv WHERE nServicioTipoId = :servicioTipoId");
        $query->bindParam(":serv", $serv);
        $query->bindParam("servicioTipoId", $servicioTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
}
