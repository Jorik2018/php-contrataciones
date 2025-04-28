<?php

require_once "../models/respuestas.php";

$RespuestasModel = new Respuestas();

$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";
$idconvocatoria = isset($_POST['proceso']) ? $_POST['proceso'] : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
            echo "No se subió ningún documento o hubo un error en la subida.";
            return;
        }

        if ($_FILES['archivo']['size'] === 0) {
            echo "El archivo está vacío.";
            return;
        }

        $mime_type = mime_content_type($_FILES['archivo']['tmp_name']);
        $allowedMimeTypes = [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];

        $maxFileSize = 25 * 1024 * 1024; // 25 MB

        if (!in_array($mime_type, $allowedMimeTypes)) {
            echo "El archivo no es un PDF o un Word válido.";
            return;
        }

        if ($_FILES['archivo']['size'] > $maxFileSize) {
            echo "El archivo excede el tamaño máximo permitido (25 MB).";
            return;
        }

        $folder_name = "../upload/";
        if (!is_dir($folder_name) && !mkdir($folder_name, 0777, true)) {
            echo "Error al crear la carpeta de subida.";
            return;
        }

        $ext = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
        $archivo = date("mdY") . round(microtime(true)) . '.' . $ext;

        if (!move_uploaded_file($_FILES['archivo']['tmp_name'], $folder_name . $archivo)) {
            echo "Hubo un error al subir el documento.";
            return;
        }

// Inserta en la base de datos (validando antes las variables necesarias)
        if ($RespuestasModel::insertar($tipo, $descripcion, $archivo, $idconvocatoria)) {
            echo "Documento Registrado.";
        } else {
            echo "Hubo un error al registrar el documento en la DB.";
        }

        break;

    case 'selectP':
        $rspt = $ConvocatoriasModel::getDataSelect();
        echo "<option value='0'>Seleccione</option>";
        foreach ($rspt as $result) {
            echo "<option value='$result->idconvocatoria'>$result->num_proceso " . $result->puesto . "</option>";
        }
        break;
}