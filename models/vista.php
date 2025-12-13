<?php

require_once "connection.php";

class Vista{
    
    static public function getDataSelect ($params){
        $status = $params["status"] ?? null; // si no existe, null
        $year   = $params["year"] ?? null;

        $sql = "SELECT 
            c.idconvocatoria,
            c.ano,
            c.vacantes,
            CONCAT(c.num_proceso, ' - ', c.ano,' - ', c.puesto, ' - vacantes (',c.vacantes,')') AS concurso_publico,
            GROUP_CONCAT(CASE WHEN r.tipo = 'anexos' THEN r.archivo END SEPARATOR ', ') AS anexos_archivos,
            GROUP_CONCAT(CASE WHEN r.tipo = 'anexos' THEN r.descripcion END SEPARATOR ', ') AS anexos_descripciones,
            GROUP_CONCAT(CASE WHEN r.tipo = 'resultados' THEN r.archivo END SEPARATOR ', ') AS resultados_archivos,
            GROUP_CONCAT(CASE WHEN r.tipo = 'resultados' THEN r.descripcion END SEPARATOR ', ') AS resultados_descripciones,
            GROUP_CONCAT(CASE WHEN r.tipo = 'observaciones' THEN r.archivo END SEPARATOR ', ') AS observaciones_archivos,
            GROUP_CONCAT(CASE WHEN r.tipo = 'observaciones' THEN r.descripcion END SEPARATOR ', ') AS observaciones_descripciones
        FROM respuestas r
        JOIN convocatorias c ON r.idconvocatoria = c.idconvocatoria
        WHERE true"
        . (!empty($status) ? " AND c.status='$status'" : " AND NOT c.status='C' ")
        . (!empty($year) ? " AND c.ano='$year'" : "")
        . " GROUP BY c.idconvocatoria";
        return Connection::executeQueryAsoc($sql);
    }

    static public function getYears ($status){
        $sql = "SELECT distinct ano FROM convocatorias WHERE status='C'";
        return Connection::executeQueryAsoc($sql);
    }

}