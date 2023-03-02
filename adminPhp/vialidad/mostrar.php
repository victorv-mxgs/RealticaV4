<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM vialidadtipo ORDER BY nVialidadTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM vialidadtipo WHERE nVialidadTipoId LIKE '%".$data."%' OR cVialidadTipo LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadvial = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadvial as $data) {
    echo "
    <tr>
            <td>" . $data['nVialidadTipoId'] . "</td> 
            <td>" . $data['cVialidadTipo'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal5' class='btn btn-success' onclick=Editarvial('" . $data['nVialidadTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarvial('" . $data['nVialidadTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
