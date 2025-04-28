<?php

require_once "connection.php";

class Vista{
    
    static public function getDataSelect (){
        $sql = "SELECT 
                c.idconvocatoria,
                c.ano,
                c.vacantes,
                CONCAT(c.num_proceso, ' - ', c.ano,' - ', c.puesto, ' - vacatentes (',c.vacantes,')') AS concurso_publico,
                GROUP_CONCAT(CASE WHEN r.tipo = 'anexos' THEN r.archivo END SEPARATOR ', ') AS anexos_archivos,
                GROUP_CONCAT(CASE WHEN r.tipo = 'anexos' THEN r.descripcion END SEPARATOR ', ') AS anexos_descripciones,
                GROUP_CONCAT(CASE WHEN r.tipo = 'resultados' THEN r.archivo END SEPARATOR ', ') AS resultados_archivos,
                GROUP_CONCAT(CASE WHEN r.tipo = 'resultados' THEN r.descripcion END SEPARATOR ', ') AS resultados_descripciones,
                GROUP_CONCAT(CASE WHEN r.tipo = 'observaciones' THEN r.archivo END SEPARATOR ', ') AS observaciones_archivos,
                GROUP_CONCAT(CASE WHEN r.tipo = 'observaciones' THEN r.descripcion END SEPARATOR ', ') AS observaciones_descripciones
            FROM respuestas r
            JOIN convocatorias c ON r.idconvocatoria = c.idconvocatoria
            GROUP BY c.idconvocatoria";
        return Connection::executeQueryAsoc($sql);
    }

}