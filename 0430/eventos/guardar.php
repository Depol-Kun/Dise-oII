<?php
require_once __DIR__ . '/../lib/conexion.php';
require_once __DIR__ . '/../lib/evento.php';

$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);
$errores = [];

if (isset($_POST)) {
    if (empty($_POST)) {
        exit;
    }

    if (empty($_POST['titulo']) || strlen($_POST['titulo']) > 100) {
        $errores[] = "El titulo es obligatorio y no debe superar 100 caracteres.";
    }
    if (empty($_POST['fecha']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['fecha'])) {
        $errores[] = "La fecha es obligatoria y debe tener formato YYYY-MM-DD.";
    }
    if (empty($_POST['hora']) || !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $_POST['hora'])) {
        $errores[] = "La hora es obligatoria y debe tener formato HH:MM o HH:MM:SS.";
    }
    if (empty($_POST['lugar']) || strlen($_POST['lugar']) > 191) {
        $errores[] = "El lugar es obligatorio y no debe superar 191 caracteres.";
    }
    if (empty($_POST['Estado']) || !in_array($_POST['Estado'], ['As definido', 'Pendiente', 'Finalizado'], true)) {
        $errores[] = "El estado es obligatorio y debe ser As definido, Pendiente o Finalizado.";
    }

    if (!empty($errores)) {
        header("Location: nuevo.php?error=1");
        exit;
    }

    $rs = $evento->insert($_POST);
    if ($rs) {
        header("Location: index.php?ok=1");
        exit;
    }

    header("Location: nuevo.php?error=1");
    exit;
}
?>
