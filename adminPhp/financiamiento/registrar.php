<?php
if (isset($_POST)) {
    $financiamiento = $_POST['financiamiento'];
    
    require("conexion.php");
    if (empty($_POST['financiamientoTipoId']) && (!empty($_POST['financiamiento']))){
        $query = $pdo->prepare("INSERT INTO financiamientoTipo (cFinanciamiento) VALUES (:fin)");
        $query->bindParam(":fin", $financiamiento);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nFinanciamientoTipoId = $_POST['financiamientoTipoId'];
        $query = $pdo->prepare("UPDATE financiamientoTipo SET cFinanciamiento = :fin  WHERE nFinanciamientoTipoId = :nFinanciamientoTipoId");
        $query->bindParam(":fin", $financiamiento);
        $query->bindParam("nFinanciamientoTipoId", $nFinanciamientoTipoId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
