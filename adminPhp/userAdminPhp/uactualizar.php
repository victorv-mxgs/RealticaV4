<?php
 if (isset($_POST)) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];

    $telefono = $_POST['telefono'];
    $tipoTelefono = $_POST['tipoTelefono'];
 
    $domicilio = $_POST['domicilio'];

    $tipoPersona = $_POST['tipoPersona'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $rfcUser = $_POST['rfcUser'];
    $suscripcion = $_POST['suscripcion'];
    $idrol = $_POST['rolid'];

    require("conexion.php");
     
         if (empty($_POST['userid']) && (!empty($_POST['nombre']))&& 
          (!empty($_POST['usuario']))&& (!empty($_POST['email']))&& 
          (!empty($_POST['apellido']))&& (!empty($_POST['telefono']))
          && (!empty($_POST['contrasena']))) {
             $sql='SELECT * from usuario where  cUsers=? ||cEmail=?';
             $sentencia=$pdo->prepare($sql);
             $sentencia->execute(array($usuario,$email));
             $result=$sentencia->fetch();
                 if($result){
                     echo "rep"; 
                     die();
                 }
          
                 else{
             $sql='SELECT * from usuario where  nTel=?';
             $sentencia=$pdo->prepare($sql);
             $sentencia->execute(array($telefono));
             $result=$sentencia->fetch();
                 if($result){
                     echo "repTel"; 
                     die();
                 }else{
                     if($password==$password2){
                        $query = $pdo->prepare("INSERT INTO usuario (nRolId,cUsers,cNombre,cApellidos,cPwd,nTel,cTelTipo,cEmail,cDomicilio,bSuscripcion,cPersonaTipo,cRFC) 
                        VALUES (:rol,:usu,:nom,:ape,:con,:tel,:tiptel,:ema,:dom,:sus,:tip,:rfc)");
                        $query->bindParam(":rol", $idrol);
                        $query->bindParam(":nom", $nombre);
                        $query->bindParam(":ape", $apellido);
                        $query->bindParam(":usu", $usuario);
                        $query->bindParam(":tel", $telefono);
                        $query->bindParam(":tiptel", $tipoTelefono);
                        $query->bindParam(":dom", $domicilio);
                        $query->bindParam(":tip", $tipoPersona);
                        $query->bindParam(":ema", $email);
                        $query->bindParam(":con", $contrasena);
                        $query->bindParam(":sus", $suscripcion);
                        $query->bindParam(":rfc", $rfcUser);
                        $query->execute();
                        $pdo = null;
                        echo "ok"; 
                     }
                     elseif{

                     }
                     else{
                         echo "dif";
                     }
                    
                 }
         
                     
                     }
         
     }
 
     else{
         
        $id = $_POST['userid'];

        $query = $pdo->prepare("UPDATE usuario set nRolId= :rol, cUsers = :usu, cNombre = :nom, cApellidos =:ape, cPwd = :con, 
        nTel = :tel, cTelTipo = :tiptel, cEmail =:ema, cDomicilio = :dom, bSuscripcion = :sus, cPersonaTipo =:tip, cRFC = :rfc WHERE nUsuarioId = :nUsuarioId");
        $query->bindParam(":rol", $idrol);
        $query->bindParam(":usu", $usuario);
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":con", $contrasena);
        $query->bindParam(":tel", $telefono);
        $query->bindParam(":tiptel", $tipoTelefono);
        $query->bindParam(":ema", $email);
        $query->bindParam(":dom", $domicilio);
        $query->bindParam(":sus", $suscripcion);
        $query->bindParam(":tip", $tipoPersona);
        $query->bindParam(":rfc", $rfcUser);
        $query->bindParam("nUsuarioId", $id);
        $query->execute();
        echo "modificado";
        $pdo = null;
     }
         
 }

/*
if (isset($_POST)) {
    
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];

    $telefono = $_POST['telefono'];
    $tipoTelefono = $_POST['tipoTelefono'];
    echo "ok"; 
    $domicilio = $_POST['domicilio'];

    $tipoPersona = $_POST['tipoPersona'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $rfcUser = $_POST['rfcUser'];
    $suscripcion = $_POST['suscripcion'];
    $idrol = $_POST['rolid'];

    require("conexion.php");

    if (empty($_POST['userid']) && (!empty($_POST['nombre']))){ 
        $query = $pdo->prepare("INSERT INTO usuario (nRolId,cUsers,cNombre,cApellidos,cPwd,nTel,cTelTipo,cEmail,cDomicilio,bSuscripcion,cPersonaTipo,cRFC) 
        VALUES (:rol,:usu,:nom,:ape,:con,:tel,:tiptel,:ema,:dom,:sus,:tip,:rfc)");
        $query->bindParam(":rol", $idrol);
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":usu", $usuario);
        $query->bindParam(":tel", $telefono);
        $query->bindParam(":tiptel", $tipoTelefono);
        $query->bindParam(":dom", $domicilio);
        $query->bindParam(":tip", $tipoPersona);
        $query->bindParam(":ema", $email);
        $query->bindParam(":con", $contrasena);
        $query->bindParam(":sus", $suscripcion);
        $query->bindParam(":rfc", $rfcUser);
        $query->execute();
        $pdo = null;
        echo "ok"; 
    }
    else{
        $id = $_POST['userid'];
        $query = $pdo->prepare("UPDATE usuario set nRolId= :rol, cUsers = :usu, cNombre = :nom, cApellidos =:ape, cPwd = :con, 
        nTel = :tel, cTelTipo = :tiptel, cEmail =:ema, cDomicilio = :dom, bSuscripcion = :sus, cPersonaTipo =:tip, cRFC = :rfc WHERE nUsuarioId = :id");
        $query->bindParam(":rol", $idrol);
        $query->bindParam(":usu", $usuario);
        $query->bindParam(":nom", $nombre);
        $query->bindParam(":ape", $apellido);
        $query->bindParam(":con", $contrasena);
        $query->bindParam(":tel", $telefono);
        $query->bindParam(":tiptel", $tipoTelefono);
        $query->bindParam(":ema", $email);
        $query->bindParam(":dom", $domicilio);
        $query->bindParam(":sus", $suscripcion);
        $query->bindParam(":tip", $tipoPersona);
        $query->bindParam(":rfc", $rfcUser);
        $query->bindParam("nUsuarioId", $id);
        $query->execute();
        $pdo = null;
        echo "modificado";
    }
    
    
    
}

*/