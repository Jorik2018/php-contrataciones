<?php

require_once "../models/convocatorias.php";

$ConvocatoriasModel = new Convocatorias();

$num = isset($_POST['num_proceso']) ? $_POST['num_proceso'] : "";
$puesto = isset($_POST['puesto']) ? $_POST['puesto'] : "";
$vacantes = isset($_POST['vacantes']) ? $_POST['vacantes'] : "";
$ano = date('Y');
$fecha_reg = date('Y-m-d');

switch ($_GET["op"]) {
    case 'guardaryeditar':

        $rspta = $ConvocatoriasModel::insertar($num, $puesto, $vacantes, $ano, $fecha_reg);
        $rspta ? "Convocatoria registrada" : "La Convocatoria no pudo ser registrada";
        echo $rspta;
        break;

    case 'selectP':
        $rspt = $ConvocatoriasModel::getDataSelect();
        echo "<option value='0'>Seleccione</option>";
        foreach ($rspt as $result) {
            echo "<option value='$result->idconvocatoria'>$result->num_proceso " . $result->puesto . "</option>";
        }
        break;
}