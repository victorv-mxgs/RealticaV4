<?php
$host = "localhost";
$user = "root";
$pass = "";
$bd   = "Realticabd";

$conexion= mysqli_connect($host,$user,$pass,$bd);

session_start();


$usuario=$_POST['usuario'];
$contraseña=$_POST['contraseña'];

$consulta="SELECT COUNT(*) as contar FROM usuario where cUsers='$usuario' and cPwd='$contraseña'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['contar']>0 ){ //55 administrador && $filas['nRolId']==55
     echo"ok";
     header("location:../perfil.html"); 
    $_SESSION['nombre_usuario']=$usuario;
    //header("location:../adminHtml/administrador.php");
   
 
  
}// else if($filas['contar']>0){
//     $_SESSION['nombre_usuario']=$usuario;
//     
      
// } 
else{
    echo"error";
    header("location:../login.html");
   
}
mysqli_free_result($resultado);
mysqli_close($conexion);
