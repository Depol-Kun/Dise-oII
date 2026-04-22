<?php
require_once __DIR__ . '/../lib/conexion.php';
require_once __DIR__ . '/../lib/inscripciones.php';
require_once __DIR__ . '/../lib/usuario.php';
require_once __DIR__ . '/../lib/evento.php';

$db = new Conex();
$con = $db->conectar();
$inscripcion = new inscripciones($con);
$usuario = new Usuario($con);
$eventos = new Evento($con);

$fila = null;
if (isset($_GET['id'])) {
    $rs = $inscripcion->getByID((int)$_GET['id']);
    $fila = $rs ? $rs->fetch_assoc() : null;
}

if (!$fila) {
    header("Location: index.php?error=1");
    exit;
}

$usuarios = $usuario->getALL();
$evento = ['id' => 0, 'titulo' => '', 'fecha' => '', 'lugar' => ''];
$ev = $eventos->getByID((int)$fila['evento_id']);
if ($ev) {
    $evento = $ev->fetch_assoc() ?: $evento;
}

$target = "actualizar.php";
$titulo_form = "Editar inscripcion";

include_once(__DIR__ . "/../parciales/templateStart.php");
include '_form.php';
include_once(__DIR__ . "/../parciales/templateEnd.php");
?>
