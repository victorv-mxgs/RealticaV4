<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM usosuelo ORDER BY nUsoSueloId ASC");
$consulta->execute();
if ($data != "") {
    $consulta = $pdo->prepare("SELECT * FROM usosuelo WHERE nUsoSueloId LIKE '%".$data."%' OR cUsoSuelo LIKE '%".$data."%'");
    $consulta->execute();
}
$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "
    <tr>
            <td>" . $data['nUsoSueloId'] . "</td> 
            <td>" . $data['cUsoSuelo'] . "</td>
            <td> 
                <button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success' onclick=Editar('" . $data['nUsoSueloId'] . "')>Editar</button>
                <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['nUsoSueloId'] . "')>Eliminar</button>
            </td>        
        </tr>"
        
        ;
}
