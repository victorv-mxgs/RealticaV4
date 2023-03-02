<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM serviciotipo ORDER BY nServicioTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM serviciotipo WHERE nServicioTipoId LIKE '%".$data."%' OR cServicio  LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadoservicio = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadoservicio as $data) {
    echo "
    <tr>
            <td>" . $data['nServicioTipoId'] . "</td> 
            <td>" . $data['cServicio'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal4' class='btn btn-success' onclick=Editarservicio('" . $data['nServicioTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarservicio('" . $data['nServicioTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
