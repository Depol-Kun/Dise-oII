<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
include "../lib/conexion.php"; // incluimos clase de conexion
include "../lib/inscripciones.php";

$db = new Conex();
$con = $db->conectar();
$datos = new Inscripciones($con);
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    if ($datos->getUsuarioId($_POST['id']) != $_POST['usuario_id']) {
        $errores[] = "El NO DEBE SER CAMBIADO.";
    }
    if (empty($_POST['usuario_id'])) {
        $errores[] = "El usuario es obligatorio.";
    }
    if (empty($_POST['eventos_id']) || strlen($_POST['eventos_id']) > 100) {
        $errores[] = "El evento es obligatorio.";
    }
    if (!in_array($_POST['estado'], [0, 1, 2])) {
        $errores[] = "El campo estado debe ser 0, 1 o 2.";
    }
    if (!in_array($_POST['checking'], [0, 1])) {
        $errores[] = "El campo check-in debe ser 0 o 1.";
    }

    if (!empty($errores)) {
        header("Location: editar.php?error=2&id=" . $_POST['id']);
        exit();
    }

    if (
        $_POST['checking'] == 1 &&
        (
            empty($_POST['fecha_checking']) ||
            $_POST['fecha_checking'] === '0000-00-00 00:00:00'
        )
    ) {
        $_POST['fecha_checking'] = date("Y-m-d H:i:s");
    } elseif ($_POST['checking'] == 0) {
        $_POST['fecha_checking'] = '0000-00-00 00:00:00';
    }
    $HoraActual = new DateTime();
    $_POST['fecha_checking'] = $HoraActual->format('Y-m-d H:i:s');

    $rs = $datos->update($_POST);
    if ($rs) {
        header("Location: index.php?ok=1&id=" . $_POST['eventos_id']);
        exit();
    }

    header("Location: editar.php?error=2&id=" . $_POST['id']);
    exit();
}