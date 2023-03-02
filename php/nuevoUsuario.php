<?php

if (isset($_POST)) {
    require_once "conexion.php";
	

    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $apellidos = $_POST['apellido']; 
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];  
    $password2 = $_POST['password2'];  
    
    
        if (empty($_POST['idusuario']) && (!empty($_POST['nombre']))&& 
         (!empty($_POST['usuario']))&& (!empty($_POST['correo']))&& 
         (!empty($_POST['apellido']))&& (!empty($_POST['telefono']))
         && (!empty($_POST['password']))) {
            $sql='SELECT * from usuario where  cUsers=? ||cEmail=?';
            $sentencia=$pdo->prepare($sql);
            $sentencia->execute(array($usuario,$correo));
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
                        $query = $pdo->prepare("INSERT INTO usuario (cUsers,cNombre,cApellidos,cPwd,nTel,cEmail) 
                    VALUES (:usu,:nom,:ape,:pwd,:tel,:email)");
                    $query->bindParam(":usu", $usuario);
                    $query->bindParam(":nom", $nombre);
                    $query->bindParam(":ape", $apellidos);
                    $query->bindParam(":email", $correo);
                    $query->bindParam(":tel", $telefono);
                    $query->bindParam(":pwd", $password);
                    $query->execute();
                    $pdo = null;
                    echo "ok";
                    }
                    else{
                        echo "dif";
                    }
                   
                }
        
                    
                    }
        
    }

    else{
        
        echo "error";
    }
        
}






