<?php
if (isset($_POST)) {
    $descripcion = $_POST['descripcionesp'];
    
    require("conexion.php");
    if (empty($_POST['espacioTipoId']) && (!empty($_POST['descripcionesp']))){
        $query = $pdo->prepare("INSERT INTO espacioTipo (cDescripcion) VALUES (:dess)");
        $query->bindParam(":dess", $descripcion);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nEspacioTipoId = $_POST['espacioTipoId'];
        $query = $pdo->prepare("UPDATE espacioTipo SET cDescripcion = :dess  WHERE nEspacioTipoId = :nEspacioTipoId");
        $query->bindParam(":dess", $descripcion);
        $query->bindParam("nEspacioTipoId", $nEspacioTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
