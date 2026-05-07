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

    $ev_id = isset($_POST['eventos_id']) ? (int)$_POST['eventos_id'] : 0;

    if (empty($_POST['usuario_id']) || !ctype_digit((string)$_POST['usuario_id'])) {
        $errores[] = "El ID de usuario es obligatorio y debe ser numérico.";
    }
    if ($ev_id <= 0) {
        $errores[] = "El ID de evento es obligatorio y debe ser numérico.";
    }
    if (!isset($_POST['estado']) || !in_array((string)$_POST['estado'], ['0', '1', '2'], true)) {
        $errores[] = "El estado es obligatorio y debe ser 0, 1 o 2.";
    }
    if (!isset($_POST['checking']) || !in_array((string)$_POST['checking'], ['0', '1'], true)) {
        $errores[] = "El checking es obligatorio y debe ser 0 o 1.";
    }
    if (isset($_POST['observacion']) && strlen($_POST['observacion']) > 65535) {
        $errores[] = "La observación no debe superar 65535 caracteres.";
    }

    if (empty($errores) && $datos->checkInscripto($ev_id, (int)$_POST['usuario_id']) > 0) {
        header("Location: nuevo.php?id=" . $ev_id . "&error=3");
        exit;
    }

    if (!empty($errores)) {
        header("Location: nuevo.php?id=" . $ev_id . "&error=1");
        exit;
    }

    $rs = $datos->insert($_POST);
    if ($rs) {
        header("Location: index.php?id=" . $ev_id . "&ok=1");
        exit;
    }

    if ((int)$con->errno === 1062) {
        header("Location: nuevo.php?id=" . $ev_id . "&error=3");
        exit;
    }

    header("Location: nuevo.php?id=" . $ev_id . "&error=1");
    exit;
}
?>
