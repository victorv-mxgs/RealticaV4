<?php
if (isset($_POST)) {
    $permiso = $_POST['permiso'];
    $descripcion = $_POST['descripcion'];
    
    require("conexion.php");
    if (empty($_POST['permisoTipoId']) && (!empty($_POST['permiso']))){
        $query = $pdo->prepare("INSERT INTO permisoTipo (cPermiso,cDescripcion) VALUES (:per,:dess)");
        $query->bindParam(":per", $permiso);
        $query->bindParam(":dess", $descripcion);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nPermisoTipoId = $_POST['permisoTipoId'];//acomodar para actualizar varios campos
        $query = $pdo->prepare("UPDATE permisoTipo SET cDescripcion = :dess  WHERE nPermisoTipoId = :permisoTipoId");
        $query->bindParam(":dess", $descripcion);
        $query->bindParam("permisoTipoId", $nPermisoTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
