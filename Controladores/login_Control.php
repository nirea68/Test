<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */
 
session_start();

require_once("../core/Sistema.php");

$usuario =  $_POST["usuario"];
$password = $_POST["password"];


$negocio = Sistema::Negocio();

$retorno = 0;

if( $negocio->validarString($usuario) && $negocio->validarString( $password) )
{

$usuario = $negocio->autenticarUsuario($usuario,$password);



    if($usuario)
    {
        $_SESSION["autenticado"] = "1";
        $_SESSION['Nombre_Usuario'] = $usuario->getNombre();
        $retorno = "1"; 
    }

}

echo $retorno;


?>