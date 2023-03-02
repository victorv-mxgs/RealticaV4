<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM espacioTipo ORDER BY nEspacioTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM espacioTipo WHERE nEspacioTipoId LIKE '%".$data."%' OR cDescripcion LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadoEspacio = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadoEspacio as $data) {
    echo "
    <tr>
            <td>" . $data['nEspacioTipoId'] . "</td> 
            <td>" . $data['cDescripcion'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal2' class='btn btn-success' onclick=EditarEspacio('" . $data['nEspacioTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=EliminarEspacio('" . $data['nEspacioTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
