<?php
header('Content-Type: application/json');
include "../lib/conexion.php";
include "../lib/usuario.php";

$db = new Conex();
$con = $db->conectar();
$usuario = new Usuario($con);   
// GetById id = $_GET['id']
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $rs = $usuario->getById($id);
} 
else {//Get all users
    $rs = $usuario->getALL();
}
$datos = [];
while ($fila = $rs->fetch_assoc()) {
    $datos[] = $fila;
}
$respuesta = [
    "status" => "success",
    "data" => $datos,
    "total" => count($datos)
];
echo json_encode($respuesta);










?>