<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */



require_once('Controladores/class.TemplatePower.inc.php');

$plantilla = new TemplatePower('Contenido/Templates/Error.tpl');

$plantilla->prepare();

$plantilla->printToScreen();




?>