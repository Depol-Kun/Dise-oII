<?php
include __DIR__ . "/../lib/conexion.php";
include __DIR__ . "/../lib/evento.php";
include __DIR__ . "/../lib/usuario.php";
include __DIR__ . "/../lib/inscripciones.php";
$db = new Conex();
$con = $db->conectar();
$eventos = new Evento($con);
$usuario = new Usuario($con);

$target = "guardar.php";
$titulo_form = "Registrar nuevo inscripto";

$ev_id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_GET['evento_id']) ? (int)$_GET['evento_id'] : 0);
$evento = ['id' => 0, 'titulo' => '', 'fecha' => '', 'lugar' => ''];
if ($ev_id > 0) {
    $ev = $eventos->getByID($ev_id);
    $evento = $ev->fetch_assoc() ?: $evento;
}

$usuarios = $usuario->getALL();
$accion ="nuevo";

$fila = [
    'id' => '',
    'eventos_id' => $ev_id,
    'usuario_id' => '',
    'estado' => 1,
    'checking' => 0,
    'observacion' => '',
    'fecha_inscripcion' => '',
    'fecha_checking' => ''
];

include_once(__DIR__ . "/../parciales/templateStart.php");
include '_form.php';
include_once(__DIR__ . "/../parciales/templateEnd.php");
?>