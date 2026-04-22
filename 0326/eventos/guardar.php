<?php
// Necesitamos incluir los archivos para que PHP sepa qué es 'Conex' y 'Evento'
require_once '/var/www/html/0326/lib/conexion.php';
require_once '/var/www/html/0326/lib/evento.php';

// Creamos los objetos necesarios
$db = new Conex();
$con = $db->conectar();
$evento = new Evento($con);
$errores = [];
if (isset($_POST) && !empty($_POST)) {
    // print_r($_POST);
    // Validaciones
    if (empty($_POST['titulo']) || strlen($_POST['titulo']) > 100) {
        $errores[] = "El título es obligatorio y no debe superar 100 caracteres.";
    }
    if (empty($_POST['fecha'])) {
        $errores[] = "La fecha es obligatoria.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['fecha'])) {
        $errores[] = "La fecha debe tener formato YYYY-MM-DD.";
    }
    if (empty($_POST['hora'])) {
        $errores[] = "La hora es obligatoria.";
    } elseif (!preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $_POST['hora'])) {
        $errores[] = "La hora debe tener formato HH:MM o HH:MM:SS.";
    }
    if (empty($_POST['lugar'])) {
        $errores[] = "El lugar es obligatorio.";
    } elseif (strlen($_POST['lugar']) > 191) {
        $errores[] = "El lugar no debe superar 191 caracteres.";
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
