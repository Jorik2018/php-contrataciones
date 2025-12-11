<?php
require_once "connection.php";

class Usuario{    
    static public function getDataSelectUsu($usuario){
        $sql = "SELECT u.NU_DOCUMENTO, u.DE_NOMBRE, u.DE_PRIMER_AP, u.DE_SEGUNDO_AP, u.DE_PASSWORD
                FROM USUARIO u
                WHERE u.ES_REGISTRO='1' AND  u.NU_DOCUMENTO='$usuario' ";
        return Connection::executeQueryAsoc($sql);
    }
}
?>