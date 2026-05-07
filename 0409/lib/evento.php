<?php
/**
 * ============================================================================
 * ARCHIVO: evento.php
 * UBICACIÓN: lib/evento.php
 * DESCRIPCIÓN: Clase Evento - Modelo que contiene todas las operaciones CRUD
 *              para la tabla 'eventos' en la base de datos 'dw2_agenda'
 * 
 * ARCHIVOS QUE USAN ESTA CLASE:
 *   - ../eventos/index.php   -> usa getALL()
 *   - ../eventos/guardar.php -> usa insert()
 *   - ../eventos/editar.php  -> usa getByID()
 *   - ../eventos/borrar.php  -> usa delete()
 *   - /var/www/html/eventos.php -> usa getALL()
 * ============================================================================
 */
class Evento {
    
    // Variable privada que almacena la conexión a la BD
    private $db;

    // Constructor: recibe la conexión y la guarda en $db
    public function __construct($con) {
        $this->db = $con;
    }

    // Obtiene todos los eventos de la tabla -> usado en index.php y eventos.php
    public function getALL() {
        $sql = "SELECT * FROM eventos;";
        $rs = $this->db->query($sql);
        return $rs;
    }

    // Obtiene un evento por su ID -> usado en editar.php
    public function getByID($id) {
        $sql = "SELECT * FROM eventos WHERE id = " . $id;
        $rs = $this->db->query($sql);
        return $rs;
    }

    // Elimina un evento por su ID -> usado en borrar.php
    public function delete($id) {
        $sql = "DELETE FROM eventos WHERE id = " . $id;
        $rs = $this->db->query($sql);
        return $rs;
    }

    // Inserta un nuevo evento con los datos del formulario -> usado en guardar.php
    public function insert($datos) {
        $sql = "INSERT INTO `eventos` (`titulo`, `fecha`, `hora`, `lugar`, `Estado`) 
            VALUES ('" . $datos['titulo'] . "', '" . $datos['fecha'] . "', '" . $datos['hora'] . "', '" . $datos['lugar'] . "', '" . $datos['Estado'] . "')";
        $rs = $this->db->query($sql);
        return $rs;
    }

    // Actualiza un evento existente -> usado en Actualizar.php (pendiente de crear)
    public function update($datos) {
        $sql = "UPDATE `eventos` SET 
                `titulo` = '" . $datos['titulo'] . "', 
                `fecha` = '" . $datos['fecha'] . "', 
                `hora` = '" . $datos['hora'] . "', 
                `lugar` = '" . $datos['lugar'] . "', 
                `Estado` = '" . $datos['Estado'] . "' 
                WHERE `id` = " . $datos['id'];
        $rs = $this->db->query($sql);
        return $rs;
    }
}
?>