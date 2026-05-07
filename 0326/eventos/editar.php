<?php
/**
 * Formulario para editar un evento existente.
 */
require_once '/var/www/html/0326/lib/conexion.php';
require_once '/var/www/html/0326/lib/evento.php';

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);

$fila = null;
if (isset($_GET['id'])){
    $rs = $evento->getByID($_GET['id']);
    $fila = $rs->fetch_assoc();
    }
$target = "actualizar.php";
include_once("/var/www/html/0402/parciales/templateStart.php");
$titulo_form = "Editar Evento";
include '_form.php';
include_once("/var/www/html/0402/parciales/templateEnd.php");
?>