<?php
$estadoId=$_GET['paramId'];

	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM municipio where nEstadoId= $estadoId ");
while($row=mysqli_fetch_array($result)){
    echo'<option value="'.$row['nMunicipioId'].'">'.$row['cMunicipio'].'</option>';
}