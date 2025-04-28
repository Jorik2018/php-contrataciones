<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Convocatorias CAS</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            body {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                background-color: #212529;
            }
            .navbar-custom {
                background-color: #dc3545;
            }
            .navbar-brand img {
                height: 60px;
            }
            .sidebar {
                background-color: grey;
                padding: 20px;
                color: white;
            }
            .sidebar .nav-link {
                color: rgba(255,255,255,.8);
                padding: 8px 16px;
                border-radius: 4px;
                margin-bottom: 5px;
            }
            .sidebar .nav-link:hover {
                color: #fff;
                background-color: rgba(255,255,255,.1);
            }
            .sidebar .nav-link.active {
                color: #fff;
                background-color: rgba(255,255,255,.1);
            }
            .main-content {
                padding: 20px;
                flex: 1;
                background-color: #fff;
                border-radius: 0 0 0 10px;
                padding-bottom: 350px;
            }
            .footer {
                background-color: #212529;
                color: white;
                padding: 50px 0;
                margin-top: auto;
            }
            .social-icons a {
                color: white;
                margin: 0 10px;
                font-size: 24px;
            }
            .container-fluid {
                padding-right: 0;
                padding-left: 0;
            }
            .row {
                margin-right: 0;
                margin-left: 0;
            }
        </style>

    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="assets/img/logoGOB.svg" alt="gob.pe">
                    |
                    OFIS – Organismo de Focalización e Información Social
                </a>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-2 sidebar">
                    <h5>Convocatorias CAS</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Convocatorias vigentes</a>
                        </li>

                    </ul>
                </div>

                <!-- Main Content -->
                <div class="col-md-10 main-content">
                    <h2>Oportunidades Laborales</h2>
                    <p>Bienvenido/a al portal web de oportunidades laborales para integrar la familia del Organismo de Focalización e Información Social - OFIS.</p>
                    <br>
                    <p>En esta sección encontrará los concursos públicos que se encuentran vigentes, es decir, en proceso de difusión y/o desarrollo de la etapa de selección.</p>
                    <br>
                    <p>Puede remitir sus consultas al correo: convocatoriascas@ofis.gob.pe en el horario de 08:30 - 17:30; cualquier comunicación recibida con posterioridad, será considerada como recibida al día hábil siguiente.</p>
                    <br>
                    <div class="table-responsive mt-4">
                        <table id="convocatorias" class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Concurso Público CAS N°</th>
                                    <th>Bases y Anexos</th>
                                    <th>Resultados</th>
                                    <th>Comunicados</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los datos se cargarán dinámicamente con DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h5>Categorías</h5>
                        <ul class="list-unstyled">
                            <div class="row">
                                <div class="col-4">
                                    <li><a href="https://www.gob.pe/institucion/ofis/contacto-y-numeros-de-emergencias" class="text-white">Contacto con OFIS</a></li>
                                    <br> 
                                    <li><a href="https://reclamos.servicios.gob.pe/?institution_id=6261" class="text-white">Reclamos de reclamaciones</a></li>
                                    <br>
                                </div>
                                <div class="col-4">
                                    <li><a href="https://facilita.gob.pe/t/21819" class="text-white">Acceso a información pública</a></li>
                                    <br>

                                    <li><a href="https://mesapartesvirtual.ofis.gob.pe/appmesapartesenlinea/inicio?tid=2*mesadepartes" class="text-white">Mesa de partes</a></li>
                                    <br>
                                </div>


                                <div class="col-4">
                                    <li><a href="https://www.gob.pe/institucion/ofis/organizacion" class="text-white">Organización</a></li>
                                    <br>

                                    <li><a href="https://www.gob.pe/institucion/ofis/funcionarios" class="text-white">Funcionarios</a></li>
                                    <br>
                                </div>  

                            </div>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Sobre el OFIS</h5>
                        <ul class="list-unstyled">
                            <li><a href="https://www.gob.pe/institucion/ofis/institucional" class="text-white">¿Qué hacemos?</a></li>
                            <br>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Síguenos</h5>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="assets/img/ofis.png" alt="OFIS" class="img-fluid" >
                    </div>
                </div>
            </div>
        </footer>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/js/all.min.js" integrity="sha512-b+nQTCdtTBIRIbraqNEwsjB6UvL3UEMkXnhzd8awtCYh0Kcsjl9uEgwVFVbhoj3uu1DO1ZMacNvLoyJJiNfcvg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function () {
                $('#convocatorias').DataTable({
                    ajax: {
                        url: 'controllers/vista.php?op=listar',
                        type: 'GET',
                        dataSrc: 'data'
                    },
                    columns: [
                        {data: 'concurso_publico', title: 'Concurso Público CAS N°'},
                        {data: 'anexos', title: 'Bases y Anexos', orderable: false},
                        {data: 'resultados', title: 'Resultados', orderable: false},
                        {data: 'observaciones', title: 'Comunicados', orderable: false}
                    ],
                    order: [[0, 'desc']],
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                    }
                });
            });
            
            
            
        </script>
    </body>
</html>