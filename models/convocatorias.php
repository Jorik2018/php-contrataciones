<?php

require_once "connection.php";

class Convocatorias{
    
    static public function getDataSelect (){
        $sql = "SELECT * FROM convocatorias order by idconvocatoria desc";
        return Connection::executeQuery($sql);
    }

    static public function insertar($num, $puesto, $vacantes, $ano, $fecha_reg){
        $sql = "INSERT INTO convocatorias (num_proceso, puesto, vacantes, ano, fecha_publicacion) VALUES (:num_proceso, :puesto, :vacantes, :ano, :fecha_publicacion)";
        $link = Connection::connect();
        $stmt = $link->prepare($sql);
        $stmt->bindParam('num_proceso', $num, PDO::PARAM_STR);
        $stmt->bindParam('puesto', $puesto, PDO::PARAM_STR);
        $stmt->bindParam('vacantes', $vacantes, PDO::PARAM_STR);
        $stmt->bindParam('ano', $ano, PDO::PARAM_STR);
        $stmt->bindParam('fecha_publicacion', $fecha_reg, PDO::PARAM_STR);
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

    static public function getTodaDataConvo(){
        $sql = "SELECT  num_proceso, puesto, vacantes, ano, CONVERT(fecha_publicacion, CHAR)as fecha_publica FROM convocatorias ORDER BY num_proceso DESC";
        return Connection::executeQueryAsoc($sql);
    }

    static public function getPorDatoConvo($puesto, $nuProceso, $nuVacantes){
        $sql = "SELECT  num_proceso, puesto, vacantes, ano, CONVERT(fecha_publicacion, CHAR)as fecha_publica FROM convocatorias ";
        $sql = $sql." WHERE ano IS NOT NULL ";
        if( $puesto!='NO' ){
            $sql = $sql." AND UPPER(puesto) LIKE UPPER('%".$puesto."%') ";
        }
        if( $nuProceso!='NO' ){
            $sql = $sql." AND num_proceso LIKE '%".$nuProceso."%' ";
        }    
        if( $nuVacantes>0 ){
            $sql = $sql." vacantes = ".$nuVacantes;
        }
        $sql = $sql." ORDER BY num_proceso DESC ";
        return Connection::executeQueryAsoc($sql);
    }

}