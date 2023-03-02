<?php
$data = file_get_contents("php://input");
require "conexion.php";
$consulta = $pdo->prepare("SELECT * FROM usuario ");
$consulta->execute();

$resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
foreach ($resultado as $data) {
    echo "
    <tr>
    <td>
    <button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success' onclick=Editar('" . $data['nUsuarioId'] . "')>Editar</button>
    <button type='button' class='btn btn-danger' onclick=Eliminar('" . $data['nUsuarioId'] . "')>Eliminar</button>
    </td> 
    <td>" . $data['nUsuarioId'] . "</td>
    <td>" . $data['nRolId'] . "</td>
    <td>" . $data['cUsers'] . "</td>
    <td>" . $data['cNombre'] . "</td>
    <td>" . $data['cApellidos'] . "</td>
    <td>" . $data['cPwd'] . "</td>
    <td>" . $data['nTel'] . "</td>
    <td>
    <button type='button' data-bs-toggle='modal' data-bs-target='#myModal' class='btn btn-success' onclick=ver_mas('" . $data['nUsuarioId'] . "')>Ver mas</button>
    </td>            
    </tr>"
        
        ;
}
