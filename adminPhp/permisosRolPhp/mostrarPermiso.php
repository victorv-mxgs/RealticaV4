<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM permisoTipo ORDER BY nPermisoTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM permisoTipo WHERE nPermisoTipoId LIKE '%".$data."%' OR cDescripcion LIKE '%".$data."%' OR cPermiso LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado1 = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado1 as $data) {
    echo "
    <tr>
            <td>" . $data['nPermisoTipoId'] . "</td>
            <td>" . $data['cPermiso'] . "</td>
            <td>" . $data['cDescripcion'] . "</td>
            <td>" . $data['dBaja'] . "</td>
            <td>
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal1' class='btn btn-success' onclick=Editarr('" . $data['nPermisoTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarr('" . $data['nPermisoTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
