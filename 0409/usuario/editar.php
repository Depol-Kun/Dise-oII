<?php
/**
 * Formulario para editar un usuario existente.
 */
require_once '/var/www/html/0409/lib/conexion.php';
require_once '/var/www/html/0409/lib/usuario.php';

$db = new Conex();
$con = $db->conectar();
$usuario = new Usuario($con);

$fila = null;
if (isset($_GET['id'])){
    $rs = $usuario->getByID($_GET['id']);
    $fila = $rs->fetch_assoc();
    }
$target = "actualizar.php";
include_once("/var/www/html/0409/parciales/templateStart.php");
$titulo_form = "Editar Usuario";
include '_form.php';
include_once("/var/www/html/0409/parciales/templateEnd.php");
?>
