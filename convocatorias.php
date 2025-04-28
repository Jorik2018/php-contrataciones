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
                    <h2 class="section-title">Gestión de Convocatorias</h2>

                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Nueva Convocatoria</h5>
                        </div>
                        <div class="card-body">
                            <form id="formConvocatoria" class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="num_proceso" class="form-label">Número de Proceso</label>
                                        <input type="text" class="form-control" id="num_proceso" name="num_proceso" required maxlength="250">
                                        <div class="invalid-feedback">Por favor ingrese el número de proceso.</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="puesto" class="form-label">Puesto</label>
                                        <input type="text" class="form-control" id="puesto" name="puesto" required maxlength="500">
                                        <div class="invalid-feedback">Por favor ingrese el puesto.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="vacantes" class="form-label">Número de Vacantes</label>
                                        <input type="number" class="form-control" id="vacantes" name="vacantes" required min="1">
                                        <div class="invalid-feedback">Por favor ingrese el número de vacantes.</div>
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
                $('#formConvocatoria').on('submit', function (e) {
                    e.preventDefault();
                    if (this.checkValidity()) {
                        $.ajax({
                            url: 'controllers/convocatorias.php?op=guardaryeditar',
                            type: 'POST',
                            data: $(this).serialize(),
                            dataType: 'json',
                            success: function (response) {
                                alert('Convocatoria guardada exitosamente');
                                limpiar();
                            },
                            error: function () {
                                alert('Error al procesar la solicitud');
                            }
                        });
                    }
                    $(this).addClass('was-validated');
                });
            });
            
            function limpiar(){
                
                $("#num_proceso").val("");
                $("#puesto").val("");
                $("#vacantes").val("");
                
            }
        </script>
    </body>
</html>