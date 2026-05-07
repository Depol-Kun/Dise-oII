<?php
/**
 * ============================================================================
 * ARCHIVO: usuario.php
 * UBICACION: lib/usuario.php
 * DESCRIPCION: Clase Usuario - Modelo con operaciones CRUD para la
 *              tabla 'usuarios' en la base de datos 'dw2_agenda'.
 *
 * ARCHIVOS QUE USAN ESTA CLASE:
 *   - ../usuario/index.php      -> usa getALL()
 *   - ../usuario/guardar.php    -> usa insert()
 *   - ../usuario/editar.php     -> usa getByID()
 *   - ../usuario/actualizar.php -> usa update()
 *   - ../usuario/borrar.php     -> usa delete()
 *   - ../inscriptos/nuevo.php   -> usa getALL() para selector de usuarios
 * ============================================================================
 */
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
        $admin_valor = ($datos['admin'] === 'si') ? 1 : 0;
        $sql = "INSERT INTO usuarios (`nombre`, `apellido`, `fenac`, `doc`, `mail`, `telefono`, `direccion`, `contrasena`, `admin`)
                VALUES ('" . $datos['nombre'] . "', '" . $datos['apellido'] . "', '" . $datos['fenac'] . "', '" . $datos['doc'] . "', '" . $datos['mail'] . "', '" . $datos['telefono'] . "', '" . $datos['direccion'] . "', '" . $datos['contrasena'] . "', " . $admin_valor . ")";
        return $this->db->query($sql);
    }

    public function update($datos) {
        $admin_valor = ($datos['admin'] === 'si') ? 1 : 0;
        $sql = "UPDATE usuarios SET
                `nombre` = '" . $datos['nombre'] . "',
                `apellido` = '" . $datos['apellido'] . "',
                `fenac` = '" . $datos['fenac'] . "',
                `doc` = '" . $datos['doc'] . "',
                `mail` = '" . $datos['mail'] . "',
                `telefono` = '" . $datos['telefono'] . "',
                `direccion` = '" . $datos['direccion'] . "',
                `contrasena` = '" . $datos['contrasena'] . "',
                `admin` = " . $admin_valor . "
                WHERE `id` = " . (int)$datos['id'];
        return $this->db->query($sql);
    }
}
?>
