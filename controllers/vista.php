<?php

require_once "../models/vista.php";

$VistaModel = new Vista();

switch ($_GET["op"]) {
    case 'listar':
        $rspt = $VistaModel::getDataSelect($_GET["status"]); 
        
        $data = []; // Inicializa el arreglo de datos

        foreach ($rspt as $fila) {
            $anexos_archivos = isset($fila['anexos_archivos']) ? $fila['anexos_archivos'] : '';
            $anexos_descripciones = isset($fila['anexos_descripciones']) ? $fila['anexos_descripciones'] : '';

            $resultados_archivos = isset($fila['resultados_archivos']) ? $fila['resultados_archivos'] : '';
            $resultados_descripciones = isset($fila['resultados_descripciones']) ? $fila['resultados_descripciones'] : '';

            $observaciones_archivos = isset($fila['observaciones_archivos']) ? $fila['observaciones_archivos'] : '';
            $observaciones_descripciones = isset($fila['observaciones_descripciones']) ? $fila['observaciones_descripciones'] : '';

            $anexos = $anexos_archivos ? implode('<br>', array_map(function ($archivo, $descripcion) {
                return '<a href="upload/' . $archivo . '" target="_blank">' . htmlspecialchars($descripcion) . '</a>';
            }, explode(', ', $anexos_archivos), explode(', ', $anexos_descripciones))) : '';

            $resultados = $resultados_archivos ? array_map(function ($archivo, $descripcion) {
                return ['fileName'=>$archivo ,'description'=>$descripcion];
            }, explode(', ', $resultados_archivos), explode(', ', $resultados_descripciones)) : '';

            $observaciones = $observaciones_archivos ? implode('<br>', array_map(function ($archivo, $descripcion) {
                return '<a href="upload/' . $archivo . '" target="_blank">' . htmlspecialchars($descripcion) . '</a>';
            }, explode(', ', $observaciones_archivos), explode(', ', $observaciones_descripciones))) : '';

            $data[] = [ // Aquí se llena el arreglo
                "concurso_publico" => $fila['concurso_publico'],
                "anexos" => $anexos,
                "resultados" => $resultados,
                "observaciones" => $observaciones
            ];
        }

        echo json_encode(["data" => $data]); // Devuelve el JSON con el arreglo lleno
        break;
}

