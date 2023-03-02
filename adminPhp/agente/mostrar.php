<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM agente ORDER BY nAgenteId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM agente WHERE nAgenteId LIKE '%".$data."%' OR cNombre LIKE '%".$data."%' OR cTelefono LIKE '%".$data."%'");
    $consulta->execute();
}
$resultadoage = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultadoage as $data) {
    echo "
    <tr>
            <td>" . $data['nAgenteId'] . "</td> 
            <td>" . $data['cNombre'] . "</td>
            <td>" . $data['cCorreo'] . "</td>
            <td>" . $data['cTelefono'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal7' class='btn btn-success' onclick=Editarage('" . $data['nAgenteId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminarage('" . $data['nAgenteId'] . "')>Eliminar</button>
            </td>        
        </tr>"
         
        ;
}
