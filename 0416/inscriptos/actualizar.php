<?php
require_once __DIR__ . '/../lib/conexion.php';
require_once __DIR__ . '/../lib/inscripciones.php';

$db = new Conex();
$con = $db->conectar();
$datos = new inscripciones($con);
$errores = [];

if (isset($_POST)) {
    if (empty($_POST)) {
        exit;
    }

    $ev_id = isset($_POST['evento_id']) ? (int)$_POST['evento_id'] : 0;

    if (empty($_POST['id']) || !ctype_digit((string)$_POST['id'])) {
        $errores[] = "El ID de inscripción es obligatorio.";
    }
    if (empty($_POST['usuario_id']) || !ctype_digit((string)$_POST['usuario_id'])) {
        $errores[] = "El ID de usuario es obligatorio y debe ser numérico.";
    }
    if ($ev_id <= 0) {
        $errores[] = "El ID de evento es obligatorio y debe ser numérico.";
    }
    if (!isset($_POST['estado']) || !in_array((string)$_POST['estado'], ['0', '1'], true)) {
        $errores[] = "El estado es obligatorio y debe ser 0 o 1.";
    }
    if (!isset($_POST['checking']) || !in_array((string)$_POST['checking'], ['0', '1'], true)) {
        $errores[] = "El checking es obligatorio y debe ser 0 o 1.";
    }
    if (isset($_POST['observacion']) && strlen($_POST['observacion']) > 65535) {
        $errores[] = "La observación no debe superar 65535 caracteres.";
    }

    if (!empty($errores)) {
        header("Location: editar.php?id=" . (int)$_POST['id'] . "&error=1");
        exit;
    }

    $rs = $datos->update($_POST);
    if ($rs) {
        header("Location: index.php?id=" . $ev_id . "&ok=2");
        exit;
    }

    header("Location: editar.php?id=" . (int)$_POST['id'] . "&error=2");
    exit;
}

?>
