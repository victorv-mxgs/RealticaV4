<?php
if (isset($_POST)) {
    $vialidad = $_POST['vialidadTipo'];
    
    require("conexion.php");
    if (empty($_POST['vialidadTipoId']) && (!empty($_POST['vialidadTipo']))){
        $query = $pdo->prepare("INSERT INTO vialidadTipo (cVialidadTipo) VALUES (:vial)");
        $query->bindParam(":vial", $vialidad);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nVialidadTipoId = $_POST['vialidadTipoId'];
        $query = $pdo->prepare("UPDATE vialidadTipo SET cVialidadTipo = :vial  WHERE nVialidadTipoId = :nVialidadTipoId");
        $query->bindParam(":vial", $vialidad);
        $query->bindParam("nVialidadTipoId", $nVialidadTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
