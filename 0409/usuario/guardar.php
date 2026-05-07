<?php
require_once '/var/www/html/0409/lib/conexion.php';
require_once '/var/www/html/0409/lib/usuario.php';

$db = new Conex();
$con = $db->conectar();
$usuario = new Usuario($con);
$errores = [];
if (isset($_POST) && !empty($_POST)) {
    if (empty($_POST['nombre']) || strlen($_POST['nombre']) > 100) {
        $errores[] = "El nombre es obligatorio y no debe superar 100 caracteres.";
    }
    if (empty($_POST['apellido']) || strlen($_POST['apellido']) > 100) {
        $errores[] = "El apellido es obligatorio y no debe superar 100 caracteres.";
    }
    if (empty($_POST['fenac']) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $_POST['fenac'])) {
        $errores[] = "La fecha de nacimiento es obligatoria y debe tener formato YYYY-MM-DD.";
    }
    if (empty($_POST['doc']) || strlen($_POST['doc']) > 191) {
        $errores[] = "El documento es obligatorio y no debe superar 191 caracteres.";
    }
    if (empty($_POST['mail']) || strlen($_POST['mail']) > 40) {
        $errores[] = "El mail es obligatorio y no debe superar 40 caracteres.";
    } elseif (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El mail debe tener un formato válido.";
    }
    if (!isset($_POST['telefono']) || $_POST['telefono'] === '' || !ctype_digit((string)$_POST['telefono'])) {
        $errores[] = "El telefono es obligatorio y debe ser numérico.";
    }
    if (empty($_POST['direccion']) || strlen($_POST['direccion']) > 100) {
        $errores[] = "La direccion es obligatoria y no debe superar 100 caracteres.";
    }
    if (!isset($_POST['contrasena']) || $_POST['contrasena'] === '' || !ctype_digit((string)$_POST['contrasena'])) {
        $errores[] = "La contrasena es obligatoria y debe ser numérica.";
    }
    if (empty($_POST['admin']) || !in_array($_POST['admin'], ['si', 'no'], true)) {
        $errores[] = "El campo admin es obligatorio y debe ser si o no.";
    }
    if (!empty($_POST['doc']) && !ctype_digit((string)$_POST['doc'])) {
        $errores[] = "El documento debe ser numérico.";
    }

    if (!empty($errores)) {
        header("Location: nuevo.php?error=1");
        exit;
    }

    $rs = $usuario->insert($_POST);
    if ($rs) {
        header("Location: index.php?ok=1");
        exit;
    }

    header("Location: nuevo.php?error=1");
    exit;
}
?>
