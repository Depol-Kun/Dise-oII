<?php

/**
 * ============================================================================
 * ARCHIVO: inscripciones.php
 * UBICACION: lib/inscripciones.php
 * DESCRIPCION: Clase inscripciones - Modelo con operaciones CRUD para
 *              la tabla 'inscriptos' y consultas relacionadas con eventos
 *              y usuarios.
 *
 * ARCHIVOS QUE USAN ESTA CLASE:
 *   - ../inscriptos/index.php      -> usa getALL() y getByEventoID()
 *   - ../inscriptos/guardar.php    -> usa insert()
 *   - ../inscriptos/editar.php     -> usa getByID()
 *   - ../inscriptos/actualizar.php -> usa update()
 *   - ../inscriptos/borrar.php     -> usa delete()
 * ============================================================================
 */
// importar conex 
class Inscripciones
{

    private $db;
    public function __construct($conn)
    {
        $this->db = $conn;
    }
    public function getALL()
    {
        $sql = "SELECT ins.*, ev.titulo, us.apellido, us.nombre,us.mail 
 FROM `inscriptos` ins
 join eventos ev on ins.eventos_id=ev.id 
 join usuarios us on ins.usuario_id=us.id"; // creamos una consulta 
        $rs = $this->db->query($sql); // ejecutamos la consulta
        return $rs;
    }
    public function getByEventoID($evento_id)
    {
        $sql = "SELECT ins.*, ev.titulo, us.apellido, us.nombre,us.mail 
 FROM `inscriptos` ins
 join eventos ev on ins.eventos_id=ev.id 
 join usuarios us on ins.usuario_id=us.id WHERE ins.eventos_id = " . $evento_id; // creamos una consulta 
        $rs = $this->db->query($sql); // ejecutamos la consulta
        return $rs;
    }
    public function getByID($dato)
    {
        $sql = "SELECT ins.*, ev.titulo, us.apellido, us.nombre,us.mail 
 FROM `inscriptos` ins
 join eventos ev on ins.eventos_id=ev.id 
 join usuarios us on ins.usuario_id=us.id WHERE `ins`.`id` = " . $dato;
        $rs = $this->db->query($sql);
        return $rs;
    }
    public function checkInscripto($evento_id, $usuario_id)
    {
        $sql = "SELECT * FROM `inscriptos` WHERE `eventos_id` = " . $evento_id . " AND `usuario_id` = " . $usuario_id;
        $rs = $this->db->query($sql);
        return $rs->num_rows;
    }
    public function getUsuarioId($id)
    {
        $sql = "SELECT usuario_id FROM `inscriptos` WHERE `id` = " . $id;
        $rs = $this->db->query($sql);
        $us = $rs->fetch_assoc();
        return $us['usuario_id'];
    }
    public function insert($datos)
    {
        $sql = "INSERT INTO `inscriptos` 
        ( `eventos_id`, `usuario_id`, `estado`, `checking`, `observacion`, `fecha_inscripcion`)
        VALUES ('" . $datos['eventos_id'] . "', '" . $datos['usuario_id'] . "', '" . $datos['estado'] . "', " . $datos['checking'] . ", '" . $datos['observacion'] . "', '" . date('Y-m-d H:i:s') . "')";
            return $this->db->query($sql);
    }
    public function update($datos)
    {
        $sql = "UPDATE `inscriptos` SET `eventos_id` = '" . $datos['eventos_id'] . "', `usuario_id` = '" . $datos['usuario_id'] . "', `estado` = '" . $datos['estado'] .  "', `checking` = " . $datos['checking'] . ", `observacion` = '" . $datos['observacion'] . "', `fecha_checking` = '" . $datos['fecha_checking'] . "' WHERE `inscriptos`.`id` = " . $datos['id'];
            return $this->db->query($sql);
    }
    public function delete($dato)
    {
        //DELETE FROM `usuarios` WHERE `usuarios`.`id` = 7
        $sql = "DELETE FROM `inscriptos` WHERE `inscriptos`.`id` = " . $dato;
        return $this->db->query($sql);
    }
}
