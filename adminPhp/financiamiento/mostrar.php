<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM financiamientoTipo ORDER BY nFinanciamientoTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM financiamientoTipo WHERE nFinanciamientoTipoId LIKE '%".$data."%' OR cFinanciamiento LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "
    <tr>
            <td>" . $data['nFinanciamientoTipoId'] . "</td> 
            <td>" . $data['cFinanciamiento'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal3' class='btn btn-success' onclick=Editarfinan('" . $data['nFinanciamientoTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarfinan('" . $data['nFinanciamientoTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
