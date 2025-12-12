<?php
if (!isset($_SESSION)) {
    session_start();
}
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="<?=$basePath?>/assets/img/favicon_ofis.ico">
        <title>OFIS</title>
        <link rel="stylesheet" href="<?=$basePath?>/vigentes/assets/css/bootstrap/bootstrap.min-alpha3.css">
        <link rel="stylesheet" href="<?=$basePath?>/vigentes/assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?=$basePath?>/assets/css/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?=$basePath?>/assets/js/jquery.gritter/css/jquery.gritter.css">        
        <link rel="stylesheet" href="<?=$basePath?>/assets/css/app.css">        
        <!--link rel="stylesheet" href="<?=$basePath?>/assets/css/styles.css"-->
    </head>
    
    <body>
        
    <div th:fragment="content">
		<div class="containerLogin">
				
			<div class="login_panel">
                <div class="panel panel-border-login">
                    
                    <div class="panel-heading">
                        <img alt="logo" width="360" height="70" class="logo-img" src="<?=$basePath?>/assets/img/ofis.jpg" /><br/>
                        <h2>Sistema Convocatoria - OFIS</h2>
                        <span class="description-login">Introduzca su informaci&oacute;n de usuario.</span>    	
                    </div>

                    <div class="panel-body">
                        <!-- Usuario -->
		                <div class="input-group col-sm-10 col-sm-offset-1">
		                    <span class="input-group-addon spam-login"><i class="fa fa-id-badge"></i></span>
		                    <input id="username" name="username" type="text" placeholder="Usuario" autocomplete="off" class="formulario_login numeric" />
		                </div>
	                    <div class="input-group margen-inf-20 col-sm-6 col-sm-offset-3">&nbsp;&nbsp;</div>
	                    <!-- Password -->
		                <div class="input-group col-sm-10 col-sm-offset-1">
		                    <span class="input-group-addon spam-login"><i class="fa fa-lock"></i></span>
		                    <input id="password" name="password" type="password" placeholder="Contrase&ntilde;a" class="formulario_login" />
		                </div>
	                    <div class="input-group margen-inf-20 col-sm-6 col-sm-offset-3">&nbsp;&nbsp;</div>	                                
	                    <!-- Captcha -->
	                    <div class="input-group col-sm-10 col-sm-offset-1">
                            <!--div class="input-group"-->
                                <span class="input-group-addon spanCaptcha" >
                                    <laberl id="captcha" class="divCaptcha"></label>
                                    <!--div id="captcha" class="divCaptcha"></div-->
                                </span>
                                <span class="input-group-addon spam-login" onclick="createCaptcha()" ><i class="fa fa-refresh btoRefrescar" title="actualizar captcha text"></i></span>
                                <input id="cpatchaTextBox" name="cpatchaTextBox" type="text" placeholder="Digite" class="form-control height39font17" maxlength="5" />
                            <!--/div-->
		                </div>
	                    <div class="input-group margen-inf-20 col-sm-6 col-sm-offset-3">&nbsp;&nbsp;</div>	                                
	                    <!-- Mensaje Error -->
		                <div align="center" id="divUsuNoExiste">
							<p style="font-size: 20; color: #FF1C19;" id="mensajeUsuNo"></p>
						</div>
						<div class="input-group margen-inf-20 col-sm-6 col-sm-offset-3">&nbsp;&nbsp;</div>
		                <!-- Boton -->
		                <div class="input-group col-sm-10 col-sm-offset-1">
                            <div class="col-sm-1"></div>
		                    <div class="col-sm-10" align="center">
			                    <button id="loginSubmit" type="button" class="btn btn-danger btoIngresar"> <!-- btoIngresar btn-ingresar -->
			                          	<i class="fa fa-sign-in"></i>&nbsp;&nbsp;Ingresar <!--fas fa-sign-in-alt  fa fa-sign-out-->
			                    </button>
			                </div>
                            <div class="col-sm-1"></div>
		                </div>
	                    <div class="input-group margen-inf-20 col-sm-6 col-sm-offset-3">&nbsp;&nbsp;</div>	                                                    
                    <div>
                </div>                            
            </div>                               
            <div class="splash-footer"><span>&#169; OFIS 2025</span></div>
            <div style="height:25px;">&nbsp;&nbsp;</div>

        </div>
    			
	</div>
            
        <script src="<?=$basePath?>/assets/js/jquery/jquery-min.js"></script>
        <script src="<?=$basePath?>/assets/js/bootstrap/popper.min.js"></script>
        <script src="<?=$basePath?>/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?=$basePath?>/assets/js/bootstrap/bootstrap.min.js"></script>
        <script src="<?=$basePath?>/assets/js/jquery.alphanum.js"></script>
        <script src="<?=$basePath?>/assets/js/jquery.gritter/js/jquery.gritter.js"></script>
        <script src="<?=$basePath?>/assets/js/app.js"></script>
        <script src="<?=$basePath?>/assets/js/seguridad/seguridad.js"></script>
        
        <script>           
        </script>

    </body>
</html>