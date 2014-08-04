<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */


require_once("../core/Sistema.php");

$negocio = Sistema::Negocio();

$idPresupuesto = $_POST["idPresupuesto"];

if( $idPresupuesto)
{
    if($negocio->procesarPresupuesto( $idPresupuesto))
    {
        echo 1;
    }else
    {
        echo 0;
    }
}



?>