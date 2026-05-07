<?php
class Usuario {
    private $db;

    public function __construct($con) {
        $this->db = $con;
    }

    public function getALL() {
        $sql = "SELECT * FROM usuarios;";
        return $this->db->query($sql);
    }

    public function getByID($id) {
        $sql = "SELECT * FROM usuarios WHERE id = " . (int)$id;
        return $this->db->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM usuarios WHERE id = " . (int)$id;
        return $this->db->query($sql);
    }

    public function insert($datos) {
        $sql = "INSERT INTO usuarios (`nombre`, `apellido`, `fenac`, `doc`, `mail`, `telefono`, `direccion`, `contrasena`, `admin`)
                VALUES ('" . $datos['nombre'] . "', '" . $datos['apellido'] . "', '" . $datos['fenac'] . "', '" . $datos['doc'] . "', '" . $datos['mail'] . "', '" . $datos['telefono'] . "', '" . $datos['direccion'] . "', '" . $datos['contrasena'] . "', '" . $datos['admin'] . "')";
        return $this->db->query($sql);
    }

    public function update($datos) {
        $sql = "UPDATE usuarios SET
                `nombre` = '" . $datos['nombre'] . "',
                `apellido` = '" . $datos['apellido'] . "',
                `fenac` = '" . $datos['fenac'] . "',
                `doc` = '" . $datos['doc'] . "',
                `mail` = '" . $datos['mail'] . "',
                `telefono` = '" . $datos['telefono'] . "',
                `direccion` = '" . $datos['direccion'] . "',
                `contrasena` = '" . $datos['contrasena'] . "',
                `admin` = '" . $datos['admin'] . "'
                WHERE `id` = " . (int)$datos['id'];
        return $this->db->query($sql);
    }
}
?>
