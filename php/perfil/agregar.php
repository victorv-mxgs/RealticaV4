<?php
if (isset($_POST)) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $tipotelefono = $_POST['tipotelefono'];
    $domicilio = $_POST['domicilioo'];
    $tipopersona = $_POST['tipopersona'];
    $rfc = $_POST['rfcc'];
   
    
    require("conexion.php");
    if (empty($_POST['usuarioId']) && (!empty($_POST['nombre']))
    && (!empty($_POST['apellido']))&& (!empty($_POST['correo']))){
        $query = $pdo->prepare("INSERT INTO usuario (cNombre,cApellidos,nTel,cEmail) 
        VALUES (:nom,:ape,:tel,:cor)");
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":cor", $correo);
        $query->bindParam(":tel", $telefono);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $nUsuarioId = $_POST['usuarioId'];
        $query = $pdo->prepare("UPDATE usuario SET cNombre =:nom,cApellidos =:ape,nTel =:tel, cTelTipo =:teltip,  cEmail= :cor, cDomicilio =:dom, cPersonaTipo =:perTip, cRFC =:rfc  WHERE nUsuarioId = :nUsuarioId");
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":cor", $correo);
        $query->bindParam(":tel", $telefono);

        $query->bindParam(":teltip", $tipotelefono);
        $query->bindParam(":dom", $domicilio);
        $query->bindParam(":perTip", $tipopersona);
        $query->bindParam(":rfc", $rfc);
        $query->bindParam("nUsuarioId", $nUsuarioId);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}
