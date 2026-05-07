<?php
header('Content-Type: application/json');
include "../lib/conexion.php";
include "../lib/evento.php";
include"../lib/inscripciones.php";

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);   
$inscripcion = new Inscripciones($con);
// GetById id = $_GET['id']
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $rs = $evento->getById($id);
} 
else {//Get all users
    $rs = $evento->getALL();
}
if(isset($_GET['inscripcion']) && !empty($_GET['inscripcion']==1)) {
    $conInscripcion = true;
}else{
    $conInscripcion = false;
}
$datos = [];
while ($fila = $rs->fetch_assoc()) {
    if ($conInscripcion) {
        $rsInscriptos = $inscripcion->getByEventoID($fila['id']);
        $lista = [];
        while ($filaInscripto = $rsInscriptos->fetch_assoc()) {
            $lista[] = $filaInscripto;
        }
        $fila['inscriptos'] = $lista;
        $fila['total_inscriptos'] = count($lista);
    }
    $datos[] = $fila;
}
$respuesta = [
    "status" => "success",
    "data" => $datos,
    "total" => count($datos)
];
echo json_encode($respuesta);










?>