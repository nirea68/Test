<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */


require_once("../core/Sistema.php");


$negocio = Sistema::Negocio();

$idProducto =  $_POST["idProducto"];
  
 $unProducto = $negocio->obtenerProdPorID($idProducto);
 
 $atributos = array( "idProducto" => $unProducto->getIdProducto(),
                     "Nombre" => $unProducto->getNombre(),
                     "Descripcion" => $unProducto->getDescripcion(),
                     "Precio" => $unProducto->getPrecioUnitario(),
                     "Imagen" => $unProducto->getUrlImg()
                    );
 

$jsonstring = json_encode(  $atributos );
echo $jsonstring;



?>