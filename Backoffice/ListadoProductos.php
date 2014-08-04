<?php 


//Inicio la sesión
session_start();

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO
if ($_SESSION["autenticado"] != "1") {
    //si no existe, envio a la página de autenticacion
    header("Location: index.php");
    //ademas salgo de este script
    exit();
}
else{

require_once('../controladores/class.TemplatePower.inc.php');
require_once("../core/Sistema.php");

$negocio = Sistema::Negocio();


$plantilla = new TemplatePower('../Contenido/Templates/ListadoProductos.tpl');

$plantilla->prepare();


foreach ( $negocio->getListadoProductosActivos() as $producto)
{
	
$plantilla->newBlock('Productos');

$plantilla->assign('IdProducto', $producto->getIdProducto());
$plantilla->assign('NombreProd', $producto->getNombre());
$plantilla->assign('PrecioProd', $producto->getPrecioUnitario());
$plantilla->assign('DescProd', $producto->getDescripcion());

}


$plantilla->printToScreen();

}

?>