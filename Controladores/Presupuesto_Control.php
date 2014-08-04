<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */
 
 
 require_once("../core/Sistema.php");


$negocio = Sistema::Negocio();
 
$datos = $_POST["datosJson"];

$arrayDatos = json_decode($datos, true);
 
$presupuesto = new Presupuesto();
 
$largoLista = count($arrayDatos);
 
 if($negocio->validarString($arrayDatos[$largoLista -1 ]["nombreSolicitante"]) &&
 $negocio->validarEmail( $arrayDatos[$largoLista -1 ]["email"]) &&
 $negocio->validarString($arrayDatos[$largoLista -1 ]["telefono"])&&
  $negocio->validarEntero( $arrayDatos[$largoLista -1 ]["cantidadPersonas"])
  )
{
    
 $presupuesto->setNombreSolicitante( $negocio->AsegurarEntradas($arrayDatos[$largoLista -1 ]["nombreSolicitante"]));
 $presupuesto->setEmailSolicitante( $negocio->AsegurarEntradas($arrayDatos[$largoLista -1 ]["email"] ));
 $presupuesto->setTelefonoSolicitante( $negocio->AsegurarEntradas($arrayDatos[$largoLista -1 ]["telefono"] ));
 $presupuesto->setTotalPersonas($negocio->AsegurarEntradas( $arrayDatos[$largoLista -1 ]["cantidadPersonas"] ));
 
    
 for( $col= 0; $col < $largoLista - 1 ; $col++ )
 {
    $unProducto = new Producto();
    
    $unProducto = $negocio->obtenerProdPorID($arrayDatos[$col]["id"]);
    
    $cantidad   = $arrayDatos[$col]["cantidad"];
 
    $item = new Item( $unProducto ,$cantidad );
    
    $presupuesto->agregarItem($item);
    
    unset($item);
    unset($unProducto);
    
 }
 

$presupuesto->guardarPresupuesto();

echo 1;

}else
{
echo 0;
}


?>
