<?php


require_once('../controladores/class.TemplatePower.inc.php');
require_once("../core/Sistema.php");

$plantilla = new TemplatePower('../Contenido/Templates/Reportes.tpl');

$negocio = Sistema::Negocio();

$plantilla->prepare();

//obtento el top 5 de los productos mas vendidos

$listaProductos = $negocio->getListadoProductosMasVendidos();

//completo el bloque ProductosMas

for ( $fila = 0 ; $fila < count( $listaProductos) ; $fila = $fila + 2  )
{

	$producto = $listaProductos[ $fila];
	
	$plantilla->newBlock('ProductosMas');
	
	$plantilla->assign('IdProducto', $producto->getIdProducto());
	$plantilla->assign('NombreProd', $producto->getNombre());
	$plantilla->assign('Cantidad', $listaProductos[ $fila + 1 ]);  

}

//destruyo las variables para evitar problemas de referencias a objetos

unset($producto);
unset($listaProductos);


//obtento el top 5 de los productos menos vendidos

$listaProductos = $negocio->getListadoProductosMenosVendidos();

//completo el bloque ProductosMenos

for ( $fila = 0 ; $fila < count( $listaProductos) ; $fila = $fila + 2  )
{

	$producto = $listaProductos[ $fila];
	
	$plantilla->newBlock('ProductosMenos');
	
	$plantilla->assign('IdProducto', $producto->getIdProducto());
	$plantilla->assign('NombreProd', $producto->getNombre());
	$plantilla->assign('Cantidad', $listaProductos[ $fila + 1 ]);  

}

//Vuelvo a la raiz para asignar las variables que me faltan

$plantilla->gotoBlock("_ROOT");


$plantilla->assign('CantidadProcesados', $negocio->obtenerCantidadPedidosProcesados());
$plantilla->assign('CantidadPendientes', $negocio->obtenerCantidadPedidosPendientes());

//imprimo en pantalla
$plantilla->printToScreen();

?>