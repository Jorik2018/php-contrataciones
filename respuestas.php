<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de Convocatorias - Panel de Administración</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <link href="/convocatorias/assets/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-9 col-lg-10 main-content">
                    <h2 class="section-title">Gestión de Respuestas</h2>

                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Nueva Respuesta</h5>
                        </div>
                        <div class="card-body">
                            <form id="formConvocatoria" class="needs-validation" enctype="multipart/form-data" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="proceso" class="form-label">Proceso</label>
                                        <select class="form-control" name="proceso" id="proceso" title="Seleccione" style="width: 100%;" >
                                        </select>
                                        <div class="invalid-feedback">Por favor seleccione la convocatoria.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tipo" class="form-label">Tipo</label>
                                        <select class="form-control" name="tipo" id="tipo" title="Seleccione" style="width: 100%;" >
                                            <option value="0">Seleccione</option>
                                            <option value="resultados">Resultado</option>
                                            <option value="observaciones">Observaciones</option>
                                            <option value="anexos">Anexos</option>
                                        </select>
                                        <div class="invalid-feedback">Por favor seleccione el tipo de respuesta.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="descripcion" class="form-label">Descripcion</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion"  maxlength="500">
                                        <div class="invalid-feedback">Por favor ingrese la respuesta.</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="archivo" class="form-label">archivo </label>
                                        <input type="file" class="form-control" id="archivo" name="archivo" accept=".pdf, .doc, .docx" >
                                        <div class="invalid-feedback">Por favor cargue el archivo.</div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Guardar Convocatoria</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                cargar_proceso();
                $('#formConvocatoria').on('submit', function (e) {
                    e.preventDefault();
                    if (this.checkValidity()) {
                        // Crear un objeto FormData para incluir el archivo
                        let formData = new FormData(this);

                        $.ajax({
                            url: 'controllers/respuestas.php?op=guardaryeditar',
                            type: 'POST',
                            data: formData, // Enviar el objeto FormData
                            processData: false, // Evitar que jQuery procese los datos
                            contentType: false, // Evitar que jQuery agregue encabezados innecesarios
                            success: function (response) {
                                alert('Respuesta guardada exitosamente');
                                limpiar();
                            },
                            error: function (response) {
                                alert('Error al procesar la solicitud');
                                console.log(response);
                            }
                        });
                    }
                    $(this).addClass('was-validated');
                });
            });

            function cargar_proceso() {
                $.post("controllers/convocatorias.php?op=selectP", function (data) {
                    $("#proceso").html(data);
                });
            }
            
            function limpiar(){
                $("#tipo").val("0").change();
                $("#proceso").val("0").change();
                $("#descripcion").val("");
                $("#archivo").val("");
                
            }
        </script>
    </body>
</html>