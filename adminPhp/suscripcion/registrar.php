<?php
if (isset($_POST)) {
    $nombresus = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $meses = $_POST['meses'];
    $publicaciones = $_POST['publicaciones'];
    
    require("conexion.php");
    if (empty($_POST['suscripTipoId']) && (!empty($_POST['nombre']))){
        $query = $pdo->prepare("INSERT INTO suscriptipo (cNombre,cDescripcion,nPrecio,nMeses,nPublicaciones) VALUES (:noms,:dessc,:pre,:mes,:publ)");
        $query->bindParam(":noms", $nombresus);
        $query->bindParam(":dessc", $descripcion);
        $query->bindParam(":pre", $precio);
        $query->bindParam(":mes", $meses);
        $query->bindParam(":publ", $publicaciones);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    } 
     
     
     
    else{
        $nSuscripTipoId = $_POST['suscripTipoId'];
        $query = $pdo->prepare("UPDATE suscriptipo SET cNombre = :noms,cDescripcion=:dessc,nPrecio=:pre,nMeses=:mes, nPublicaciones =:publ WHERE nSuscripTipoId = :nSuscripTipoId");
        $query->bindParam(":noms", $nombresus);
        $query->bindParam(":dessc", $descripcion);
        $query->bindParam(":pre", $precio);
        $query->bindParam(":mes", $meses);
        $query->bindParam(":publ", $publicaciones);
        $query->bindParam("nSuscripTipoId", $nSuscripTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
