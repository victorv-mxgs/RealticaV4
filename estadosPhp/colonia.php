<?php
$localidadId=$_GET['paramId'];

	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM colonia where nLocalidadId= $localidadId ");
while($row=mysqli_fetch_array($result)){
    echo'<option value="'.$row['nColoniaId'].'">'.$row['cColonia'].'</option>';
}