<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM agente");
while($row=mysqli_fetch_array($result)){
    echo'<option value="'.$row['nAgenteId'].'">'.$row['cNombre'].'</option>';
}