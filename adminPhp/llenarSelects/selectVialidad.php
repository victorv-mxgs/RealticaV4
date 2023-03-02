<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM  vialidadtipo");
while($row=mysqli_fetch_array($result)){
    echo'<option value="'.$row['nVialidadTipoId'].'">'.$row['cVialidadTipo'].'</option>';
}