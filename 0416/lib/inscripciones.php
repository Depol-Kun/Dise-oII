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
class inscripciones
{
    private $db;

    public function __construct($con)
    {
        $this->db = $con;
    }

    public function getALL()
    {
        $sql = "SELECT ins.id, ins.eventos_id AS evento_id, ins.usuario_id, ins.estado, ins.checking, ins.fecha_Inscripcion AS fecha_inscripcion, ins.fecha_Checking AS fecha_checking, ins.observacion, ev.titulo, us.apellido, us.nombre, us.mail 
    FROM `inscriptos` ins
    join eventos ev on ins.eventos_id = ev.id 
    join usuarios us on ins.usuario_id = us.id"; // creamos una consulta 
        $rs = $this->db->query($sql); // ejecutamos la consulta
        return $rs;
    }
    public function getByEventoID($evento_id)
    {
        $sql = "SELECT ins.id, ins.eventos_id AS evento_id, ins.usuario_id, ins.estado, ins.checking, ins.fecha_Inscripcion AS fecha_inscripcion, ins.fecha_Checking AS fecha_checking, ins.observacion, ev.titulo, us.apellido, us.nombre, us.mail 
    FROM `inscriptos` ins
    join eventos ev on ins.eventos_id = ev.id 
     join usuarios us on ins.usuario_id = us.id WHERE ins.eventos_id = " . (int)$evento_id; // creamos una consulta 
        $rs = $this->db->query($sql); // ejecutamos la consulta
        return $rs;
    }
    public function getByID($dato)
    {
        $sql = "SELECT ins.id, ins.eventos_id AS evento_id, ins.usuario_id, ins.estado, ins.checking, ins.fecha_Inscripcion AS fecha_inscripcion, ins.fecha_Checking AS fecha_checking, ins.observacion, ev.titulo, us.apellido, us.nombre, us.mail 
    FROM `inscriptos` ins
    join eventos ev on ins.eventos_id = ev.id 
    join usuarios us on ins.usuario_id = us.id WHERE `ins`.`id` = " . (int)$dato;
        $rs = $this->db->query($sql);
        return $rs;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM inscriptos WHERE id = " . (int)$id;
        return $this->db->query($sql);
    }

    public function insert($datos)
    {
        $sql = "INSERT INTO inscriptos (`eventos_id`, `usuario_id`, `estado`, `checking`, `fecha_Inscripcion`, `observacion`) VALUES (" .
            (int)$datos['evento_id'] . ", " .
            (int)$datos['usuario_id'] . ", " .
            (int)$datos['estado'] . ", " .
            (int)$datos['checking'] . ", NOW(), '" .
            $this->db->real_escape_string($datos['observacion']) . "')";
        return $this->db->query($sql);
    }

    public function update($datos)
    {
        $sql = "UPDATE inscriptos SET
            `eventos_id` = " . (int)$datos['evento_id'] . ",
            `usuario_id` = " . (int)$datos['usuario_id'] . ",
            `estado` = " . (int)$datos['estado'] . ",
            `checking` = " . (int)$datos['checking'] . ",
            `observacion` = '" . $this->db->real_escape_string($datos['observacion']) . "'
            WHERE `id` = " . (int)$datos['id'];
        return $this->db->query($sql);
    }
}
