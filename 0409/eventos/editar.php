<?php
require_once '/var/www/html/0409/lib/conexion.php';
require_once '/var/www/html/0409/lib/evento.php';

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);

$fila = null;
if (isset($_GET['id'])) {
    $rs = $evento->getByID($_GET['id']);
    $fila = $rs->fetch_assoc();
}

$target = "actualizar.php";
$titulo_form = "Editar Evento";

include_once("/var/www/html/0409/parciales/templateStart.php");
include '_form.php';
include_once("/var/www/html/0409/parciales/templateEnd.php");
?>
