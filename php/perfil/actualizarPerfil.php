<?php
    $data = file_get_contents("php://input");
      $servidor = "mysql:dbname=Realticabd;host=localhost";
      $user = "root";
      $pass = "";
      try {
          $pdo = new PDO($servidor, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
      } catch (PDOException $e) {
          echo "conexion fallida" .$e->getMessage();
      }
  
    $query = $pdo->prepare("SELECT * FROM usuario WHERE nUsuarioId  = :nUsuarioId ");
    $query->bindParam(":nUsuarioId", $data);
    $query->execute();
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    echo json_encode($resultado);
 