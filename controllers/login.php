<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers:Content-Type, X-Requested-With, X-PINGOTHER, X-File-Name, Cache-Control');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);

require_once "../models/login.php";

$VistaModelUsu = new Usuario();
$usuario = "";
$password = "";

if( !empty($_GET['usuario']) || !empty($_GET['contrasena']) ){
    
    $usuario = $_GET['usuario'];
    $password = $_GET['contrasena'];

    $rspt = $VistaModelUsu::getDataSelectUsu($usuario); 
    $data = array();
    $nuFila = 0;

    $coResp="";
    $deResp="";
    $nuDoc="";
    $dePriAp="";
    $deSegAp="";
    $deNom="";
    $pass="";

    
        foreach ($rspt as $fila) {
            if( !empty($fila['NU_DOCUMENTO'] ) ){

                $data[] = array(
                  'nuDoc'=> $fila['NU_DOCUMENTO'],
                  'dePriAp'=>$fila['DE_PRIMER_AP'],
                  'deSegAp'=>$fila['DE_SEGUNDO_AP'],
                  'deNom'=>$fila['DE_NOMBRE']                  
                );
                $nuDoc=$fila['NU_DOCUMENTO'];
                $dePriAp=$fila['DE_PRIMER_AP'];
                $deSegAp=$fila['DE_SEGUNDO_AP'];
                $deNom=$fila['DE_NOMBRE'];
                $pass=$fila['DE_PASSWORD'];

                $nuFila=$nuFila+1;
                break;
            }
        }
    

    if($nuFila>0){
        if( $nuDoc==$usuario && $pass==$password){
            $coResp="0000";
            $deResp="usuario y Contraseña valido.";
            /*
            session_start();
            $_SESSION["nombreApellidos"] = $deNom.", ".$dePriAp." ".$deSegAp;
            session_unset();
            $_SESSION["nombre"] = $deNom;
            $_SESSION["primerAp"] = $dePriAp;
            $_SESSION["segundoAp"] = $deSegAp;
            $_SESSION["usuario"] = $nuDoc;
            header("Location:http://localhost/email/emp_sis/contratacionesv/vigentes/views/index.php");
            */
            //print "<p>Su USUARIO es $nuDoc.</p>\n";           
            /*
            print "<pre>\n";
            print_r ($_SESSION);
            print "</pre>\n";
            print "<p>Su USUARIO es ".$_SESSION["usuario"]."</p>\n";
            */
        }else{
            if( $nuDoc!=$usuario && $pass!=$password){
                $coResp="8888";
                $deResp="Usuario y contraseña errado.";
            }else{
                if( $nuDoc==$usuario && $pass!=$password){
                    $coResp="0002";
                    $deResp="Contraseña errado.";
                }
                if( $nuDoc!=$usuario && $pass==$password){
                    $coResp="0001";
                    $deResp="Usuario errado.";
                }
            }    
        }
    }else{
        $coResp="9999";
        $deResp="El usuario no se eccuentra registrado";
    }
    
    //returns data as JSON format
    $resultado['status'] = 'ok';
    $resultado['coRespuesta'] = $coResp;
    $resultado['deRespuesta'] = $deResp;
    $resultado['nrofila'] = $nuFila;  
    //$resultado['json'] = json_encode(array("data"=>$data));
    $resultado['json'] = $data;
    echo json_encode($resultado); 
}else{
    $resultado['status'] = 'ok';
    $resultado['coRespuesta'] = '7777';
    echo json_encode($resultado); 
}
?>