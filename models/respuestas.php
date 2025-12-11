<?php

require_once "connection.php";

class Respuestas{
    
    /*
    static public function getDataSelect (){
        $sql = "SELECT * FROM convocatorias";
        return Connection::executeQuery($sql);
    }
    */
    static public function getDataSelect (){
        $sql = "SELECT * FROM convocatorias WHERE not status='C' order by idconvocatoria desc";
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

    static public function getRespuesta(){
        //$sql = "SELECT r.idconvocatoria, (select c.puesto from convocatorias c where c.idconvocatoria=r.idconvocatoria) as puesto, r.tipo, r.descripcion, r.archivo, r.idconvocatoria FROM respuestas r ";     
        $sql = "SELECT CONVERT(r.idconvocatoria, CHAR) as idconvocatoria, c.puesto, r.tipo, r.descripcion, r.archivo, CONVERT(r.idconvocatoria, CHAR) as idrespuesta FROM respuestas r INNER JOIN convocatorias c ON r.idconvocatoria=c.idconvocatoria order by r.idrespuesta desc "; 
        return Connection::executeQueryAsoc($sql);
    }

    static public function getRespuestaData($idProceso, $Tipo, $deRespuesta){
        $sql = "SELECT CONVERT(r.idconvocatoria, CHAR) as idconvocatoria, (select c.puesto from convocatorias c where c.idconvocatoria=r.idconvocatoria) as puesto, r.tipo, r.descripcion, r.archivo, CONVERT(r.idconvocatoria, CHAR) as idrespuesta FROM respuestas r WHERE r.idrespuesta is not null";
        if( $idProceso!="NO" ){
            $sql = $sql." AND r.idconvocatoria=".$idProceso;
        }
        if( $Tipo!="NO" ){            
            $sql = $sql." AND UPPER(r.tipo) LIKE UPPER('%".$Tipo."%')";
        }
        if( $deRespuesta!="NO" ){
            $sql = $sql." AND UPPER(r.descripcion) LIKE UPPER('%".$deRespuesta."%')";
        }
        $sql = $sql." order by r.idrespuesta desc ";
        return Connection::executeQueryAsoc($sql);
    }
}
