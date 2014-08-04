<?php


require_once('../controladores/class.TemplatePower.inc.php');
require_once("../core/Sistema.php");

$negocio = Sistema::Negocio();


$plantilla = new TemplatePower('../Contenido/Templates/ListadoPresupuestos.tpl');

$plantilla->prepare();


foreach ( $negocio->ObtenerListaPresupuestosSinProcesar() as $presupuesto)
{

$plantilla->newBlock('Presupuestos');


$plantilla->assign('IdPresupuesto',$presupuesto->getIdPresupuesto() );
$plantilla->assign('CantPersonas',$presupuesto->getTotalPersonas() );
$plantilla->assign('Fecha',$presupuesto->getFecha() );
$plantilla->assign('ImporteTotal',$presupuesto->obtenerImporteTotalPresupuesto() );
$plantilla->assign('Solicitante',$presupuesto->getNombreSolicitante() );

$plantilla->assign('Tel',$presupuesto->getTelefonoSolicitante() );
$plantilla->assign('email',$presupuesto->getEmailSolicitante() );

$plantilla->assign('IdPresupuesto',$presupuesto->getIdPresupuesto() );

}


$plantilla->printToScreen();


?>