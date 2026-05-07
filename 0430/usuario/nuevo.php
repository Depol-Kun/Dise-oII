<?php
$target = "guardar.php";
$titulo_form = "Agregar Nuevo Usuario";
$fila = [
    'id' => '',
    'nombre' => '',
    'apellido' => '',
    'fenac' => '',
    'doc' => '',
    'mail' => '',
    'telefono' => '',
    'direccion' => '',
    'contrasena' => '',
    'admin' => 'no'
];

include_once(__DIR__ . "/../parciales/templateStart.php");
include '_form.php';
include_once(__DIR__ . "/../parciales/templateEnd.php");
?>=