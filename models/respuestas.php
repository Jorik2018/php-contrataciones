<?php

require_once "connection.php";

class Respuestas{
    
    static public function getDataSelect (){
        $sql = "SELECT * FROM convocatorias";
        return Connection::executeQuery($sql);
    }

    static public function insertar($tipo, $descripcion, $archivo, $idconvocatoria){
        $sql = "INSERT INTO respuestas (tipo, descripcion, archivo, idconvocatoria) VALUES (:tipo, :descripcion, :archivo, :idconvocatoria)";
        $link = Connection::connect();
        $stmt = $link->prepare($sql);
        $stmt->bindParam('tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindParam('descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam('archivo', $archivo, PDO::PARAM_STR);
        $stmt->bindParam('idconvocatoria', $idconvocatoria, PDO::PARAM_STR);
        return $stmt->execute();
    }

    static public function editar($identidad, $nombre, $ruc, $direccion){
        $sql = "UPDATE entidades SET nombre = :nombre, ruc = :ruc, direccion = :direccion WHERE identidad = :identidad";
        $link = Connection::connect();
        $stmt = $link->prepare($sql);
        $stmt->bindParam('identidad', $identidad, PDO::PARAM_STR);
        $stmt->bindParam('nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam('ruc', $ruc, PDO::PARAM_STR);
        $stmt->bindParam('direccion', $direccion, PDO::PARAM_STR);
        return $stmt->execute();
    }

    static public function mostrar($identidad){
        $sql = "SELECT * FROM entidades WHERE identidad = '$identidad'";
        return Connection::executeQuery($sql);
    }

}