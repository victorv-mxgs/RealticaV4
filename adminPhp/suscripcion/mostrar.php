<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM suscriptipo ORDER BY nSuscripTipoId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM suscriptipo WHERE nSuscripTipoId LIKE '%".$data."%' OR cNombre LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadosusc = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadosusc as $data) {
    echo "
    <tr>
            <td>" . $data['nSuscripTipoId'] . "</td> 
            <td>" . $data['cNombre'] . "</td>
            <td>" . $data['cDescripcion'] . "</td> 
            <td>" . $data['nPrecio'] . "</td>
            <td>" . $data['nMeses'] . "</td> 
            <td>" . $data['nPublicaciones'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal6' class='btn btn-success' onclick=Editarsusc('" . $data['nSuscripTipoId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarsusc('" . $data['nSuscripTipoId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
