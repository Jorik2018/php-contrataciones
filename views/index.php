<?php
//print "<p>Su SESSION es ".$_SESSION."</p>\n";
//print "<p>Su USUARIO es ".$_SESSION["usuario"]."</p>\n";
/*
if( !isset($_SESSION) ) {
    print "<p>No sé su nombre.</p>\n";
    define('MSG_ERROR',"<font face='Arial' size='3' color=#d50000><b>Usuario no acreditado. Ingresar con usuario y password</b></font>");

    print(MSG_ERROR);
    exit();
} else {
    //print "<p>Su nombre es $_SESSION[nombre].</p>\n";
    //$.nombres=$_SESSION["nombre"];
    //$.apellidos=$_SESSION["primerAp"]." ".$_SESSION["segundoAp"];
    //$.usuarios = $_SESSION["usuario"];
    //print "<p>Su nombre es $_SESSION[nombre].</p>\n";
    print "<p>Su USUARIO es $_SESSION[usuario].</p>\n";
}
*/ 
$currentFile = realpath(__FILE__);

// Ruta absoluta del public root (DocumentRoot)
$docRoot = realpath($_SERVER['DOCUMENT_ROOT']);

// Calculamos el path relativo del proyecto
$relativePath = str_replace($docRoot, '', dirname($currentFile));

// Lo dejamos con slash al final siempre
$basePath = rtrim($relativePath, '/') . '/'; // sube 1 nivel → /miProyecto
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

        <!--link href="<?=$basePath?>/assets/css/styles.css" rel="stylesheet" />        
        <script src="<?=$basePath?>/assets/js/fontawesome/all.js" crossorigin="anonymous"></script-->
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-ofis bg-ofis"> <!--navbar-dark bg-dark ---  navbar-ofis bg-ofis  -->
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="<?=$basePath?>/views/index.php"></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link-ofis btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> <!-- btn-link -->
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
                <nav class="sb-sidenav accordion sb-sidenav-ofis" id="sidenavAccordion"> <!-- sb-sidenav-light -  sb-sidenav-dark -->
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading menu">MENÚ</div> <!-- sb-sidenav-menu-heading -->                           
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
                        <h1 class="mt-4">Inicio</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Inicio</li>
                        </ol>
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
        <script src="<?=$basePath?>/assets/js/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/bootstrap/popper.min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/jquery/jquery-min.js" crossorigin="anonymous"></script>
        <script src="<?=$basePath?>/assets/js/datatables/dataTables.js" crossorigin="anonymous"></script>                
          
        <script src="<?=$basePath?>/assets/js/scripts.js" crossorigin="anonymous"></script>
        
    </body>
</html>
