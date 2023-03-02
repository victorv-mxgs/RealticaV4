<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM rol ORDER BY nRolId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM rol WHERE nRolId LIKE '%".$data."%' OR cRol LIKE '%".$data."%' OR cRol LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "
    <tr>
            <td>" . $data['nRolId'] . "</td> 
            <td>" . $data['cRol'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success' onclick=Editar('" . $data['nRolId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['nRolId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
