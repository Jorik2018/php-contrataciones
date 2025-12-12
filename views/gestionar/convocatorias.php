<?php
$parts = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
$basePath = '/' . $parts[0].'/' . $parts[1];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <link rel="shortcut icon" href="<?=$basePath?>/assets/img/favicon_ofis.ico">
        <title>Convocatoria</title>
        
        <link href="<?=$basePath?>/assets/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
        <link href="<?=$basePath?>/assets/css/datatables/dataTables.css" rel="stylesheet" />
        <link href="<?=$basePath?>/assets/css/styles.css" rel="stylesheet" />
        <script src="<?=$basePath?>/assets/js/fontawesome/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-ofis bg-ofis">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?=$basePath?>/views/index.php"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link-ofis btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->            
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0 cabezaTitulo">SISTEMA DE CONVOCATORIA</div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link-ofis dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item hiderBtoSalir" href="<?=$basePath?>/login.php"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Salir</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-ofis" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading menu">MENÚ</div>                            
                            <div class="sb-sidenav-menu-heading">GESTINAR</div>
                            <a class="nav-link" href="<?=$basePath?>/views/gestionar/convocatorias.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Convocatorias
                            </a>
                            <a class="nav-link" href="<?=$basePath?>/views/gestionar/respuestas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Respuestas
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer pieMenu">
                        <div class="small">Convocatoria</div>
                        OFIS v1.0
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Gestionar Convocatorias</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?=$basePath?>/views/index.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Convocatorias</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><i class="far fa-keyboard me-1"></i>&nbsp;Registrar Nueva Convocatoria</h5>
                            </div>
                            <div class="card-body">
                                <form id="formConvocatoria" class="needs-validation" enctype="multipart/form-data" novalidate>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="puesto" class="form-label">Puesto</label>
                                            <input type="text" class="form-control" id="puesto" name="puesto" required maxlength="500">
                                            <div class="invalid-feedback">Por favor ingrese el puesto.</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="num_proceso" class="form-label">Número de Proceso</label>
                                            <input type="text" class="form-control" id="num_proceso" name="num_proceso" required maxlength="250">
                                            <div class="invalid-feedback">Por favor ingrese el número de proceso.</div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="vacantes" class="form-label">Número de Vacantes</label>
                                            <input type="number" class="form-control" id="vacantes" name="vacantes" required min="1">
                                            <div class="invalid-feedback">Por favor ingrese el número de vacantes.</div>
                                        </div>
                                        <div class="col-md-1 mb-3"></div>
                                        <div class="col-md-2 mb-3 botRegistrar">
                                            <button type="button" class="btn btn-danger" id="btoGrabar"><i class="far fa-save me-1"></i>&nbsp;Guardar</button>&nbsp;&nbsp;
                                            <button type="button" class="btn btn-warning" id="btoLimpiar"><i class="far fa-trash-alt me-1"></i>&nbsp;Limpiar</button>
                                        </div>
                                    </div>                                    
                                </form>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table me-1"></i>&nbsp;Listado Convocatoria</div>
                            <div class="card-body">
                                <div class="row">                                    
                                    <div class="col-md-5 mb-3">
                                        <input type="text" class="form-control" id="puestoBus" placeholder="Puesto a buscar" required maxlength="500">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <input type="text" class="form-control" id="nuProcesoBus" placeholder="Proceso a buscar" required maxlength="250">
                                    </div>  
                                    <div class="col-md-1 mb-3">
                                            <input type="number" class="form-control" id="nuVacantesBus" placeholder="Vacantes" required min="1">
                                    </div> 
                                    <div class="col-md-2 mb-3 botRegistrar">
                                        <button type="button" class="btn btn-danger" id="btoBuscar"><i class="fas fa-search me-1"></i>&nbsp;Buscar</button>&nbsp;&nbsp;
                                        <button type="button" class="btn btn-warning" id="btoLimpiarBus"><i class="far fa-trash-alt me-1"></i>&nbsp;Limpiar</button>
                                    </div>  
                                </div>
                                <div class="row">                                        
                                    <table id="tResultConvocatoria" class="display"></table>
                                </div>
                            </div>
                        </div>

                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="col-md-12 text-muted piePagina">
                                Copyright &copy; Sistema de Convocatoria - OFIS - 2025<br>
                                Desarrollado por la Direcci&oacute;n de Sistemas de Informaci&oacute;n Social - OFIS<br>
                                Jir&oacute;n de la Unión 264 Piso 6 y 8 - Lima, Lima, Per&uacute;
                            </div>                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalMensaje" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><!-- -->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header modalTitulo">
                        <h5 class="modal-title" id="tituloModalLabel">SISTEMA DE CONVOCATORIA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="modal-title" id="textoModalLabel"></h6>
                        <!-- fas fa-question-circle -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-sign-out me-1"></i>Cerrar</button>                    
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="btoGrabarFinal"><i class="far fa-save me-1"></i>&nbsp;Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Striped Progress Bars -->
        <div class="modal fade" id="modalBarraProgreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"><!--  -->
            <div class="modal-dialog modalBarProgTop">
                <div class="modal-content">
                    <div class="modal-header modalTitulo">
                        <h5 class="modal-title" id="tituloModalLabel">SISTEMA DE CONVOCATORIA</h5>
                        <button type="button" id="cerrarBarra" class="btn-close cerrarBarra" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="modal-title" id="textoBarProgresoLabel">Se esta procesando por favor esperar...</h6>
                        <div class="progress">                            
                            <div class="progress-bar bg-success progress-bar-striped" style="width:40%">40%</div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        
        <script src="<?=$basePath?>/assets/js/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/bootstrap/popper.min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/jquery/jquery-min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/datatables/dataTables.js" crossorigin="anonymous"></script>

        <script src="<?=$basePath?>/assets/js/scripts.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/gestionar/convocatorias.js" crossorigin="anonymous"></script>        
    </body>
</html>