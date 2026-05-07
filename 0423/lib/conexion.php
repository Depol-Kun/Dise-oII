<?php 
/**
 * ============================================================================
 * ARCHIVO: conexion.php
 * UBICACION: lib/conexion.php
 * DESCRIPCION: Clase Conex - Encapsula la conexion a MariaDB/MySQL
 *              para la base de datos 'dw2_agenda'.
 *
 * ARCHIVOS QUE USAN ESTA CLASE:
 *   - ../eventos/*.php    -> crea Conex y llama conectar()
 *   - ../usuario/*.php    -> crea Conex y llama conectar()
 *   - ../inscriptos/*.php -> crea Conex y llama conectar()
 * ============================================================================
 */
// aqui se realiza una clase donde se crean variables privadas de la conexion
final class Conex {
private $host = "mariadb";
private $usuario = "root";
private $password = "root";
private $db = "dw2_agenda";
public $conexion;
    /**
     * Establece la comunicación entre PHP y el motor MariaDB/MySQL 
     * utilizando las propiedades internas de la clase mediante $this.*/
    public function conectar() {
        $this ->conexion = new mysqli(
            $this -> host,
            $this -> usuario,
            $this -> password,
            $this -> db
            );
        // detiene la ejecucion si se comprueba que hay un error de conexion
        if  ($this ->conexion -> connect_error){
            die("Error de conexion");
        }
        // si no hay error, retorna la conexion
    return  $this ->conexion;
    }
}
?>