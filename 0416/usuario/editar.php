<?php
/**
 * Formulario para editar un usuario existente.
 */
require_once __DIR__ . '/../lib/conexion.php';
require_once __DIR__ . '/../lib/usuario.php';

$db = new Conex();
$con = $db->conectar();
$dato = new Usuario($con);

$fila = null;
if (isset($_GET['id'])){
    $rs = $dato->getByID($_GET['id']);
    $fila = $rs->fetch_assoc();
    }
$target = "actualizar.php";
include_once(__DIR__ . "/../parciales/templateStart.php");
$titulo_form = "Editar Usuario";
include '_form.php';
include_once(__DIR__ . "/../parciales/templateEnd.php");
?>
