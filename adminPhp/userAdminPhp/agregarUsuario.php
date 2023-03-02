<?php
 if (isset($_POST)) {//1
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];

    $telefono = $_POST['telefono'];
    $tipoTelefono = $_POST['tipoTelefono'];
 
    $domicilio = $_POST['domicilio'];

    $tipoPersona = $_POST['tipoPersona'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $contrasena2 = $_POST['contrasena2'];

    $rfcUser = $_POST['rfcUser'];
    $suscripcion = $_POST['suscripcion'];
    $idrol = $_POST['rolid'];
    $id = $_POST['userid'];

    require("conexion.php");
    
    if (empty($_POST['userid']) && (!empty($_POST['nombre']))&& 
    (!empty($_POST['usuario']))&& (!empty($_POST['email']))&& 
    (!empty($_POST['apellido']))&& (!empty($_POST['telefono']))
    && (!empty($_POST['contrasena']))) {//3
        $sql='SELECT * from usuario where  cUsers=? ||cEmail=?';
        $sentencia=$pdo->prepare($sql);
        $sentencia->execute(array($usuario,$email));
        $result=$sentencia->fetch();
            if($result){//5
                echo "rep"; 
                die();
            }//5
            else{//6
                $sql='SELECT * from usuario where  nTel=?';
                $sentencia=$pdo->prepare($sql);
                $sentencia->execute(array($telefono));
                $result=$sentencia->fetch();
                    if($result){//7
                        echo "repTel"; 
                        die();
                    }//7
                    else{//8
                        if($contrasena==$contrasena2){//9
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
                           echo "ok"; 
                           $pdo = null;
                           echo "ok"; 
                        }//9
                        else{//10
                            echo "dif";
                        }//10
                    }//8
            }//6
    }//3
    else{//4
        
            echo "dif";
        
    }//4

   
  
 }//1

 else{//2
         
       
 }//2