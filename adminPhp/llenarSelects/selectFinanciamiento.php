<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$baseDedatos="Realticabd";

	$conexion = mysqli_connect($servidor, $usuario, $clave, $baseDedatos);
$result=mysqli_query($conexion,"SELECT * FROM financiamientoTipo");
while($row=mysqli_fetch_array($result)){
    echo'<option value="'.$row['nFinanciamientoTipoId'].'">'.$row['cFinanciamiento'].'</option>';
}
 