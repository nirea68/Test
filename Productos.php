<?php 


require_once('Controladores/class.TemplatePower.inc.php');
require_once("Core/Sistema.php");


$plantilla = new TemplatePower('Contenido/Templates/Productos.tpl');

$plantilla->prepare();


$negocio = Sistema::Negocio();


foreach ( $negocio->getListadoProductosActivos() as $producto)
{
	
$plantilla->newBlock('Productos');

$plantilla->assign('NombreProd', $producto->getNombre());
$plantilla->assign('ImgProd', $producto->getUrlImg());
$plantilla->assign('PrecioProd', $producto->getPrecioUnitario());
$plantilla->assign('DescProd', $producto->getDescripcion());
 

    for ( $contador = 1; $contador <= 100; $contador++)
    {
		$plantilla->newBlock('select');
        $plantilla->assign('Numero', $contador);
    }
    
	$plantilla->gotoBlock('Productos');
	
    $plantilla->assign('IdProd', $producto->getIdProducto());
	$plantilla->assign('HiddNombreProd', $producto->getNombre());
	$plantilla->assign('HiddPrecioProd', $producto->getPrecioUnitario());


}


$plantilla->printToScreen();

?>