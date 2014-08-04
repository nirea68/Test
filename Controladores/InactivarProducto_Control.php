<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */



 require_once("../core/Sistema.php");


$negocio = Sistema::Negocio();

$idProducto = $_POST["idProducto"];

$retorno = 0;

if ($negocio->validarEntero($idProducto))
{
    if ($negocio->inactivarProducto($idProducto))
    {
       $retorno = 1; 
        
    }
}

echo $retorno;


?>