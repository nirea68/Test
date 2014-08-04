<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */



require_once('Controladores/class.TemplatePower.inc.php');

$plantilla = new TemplatePower('Contenido/Templates/Index.tpl');

$plantilla->prepare();

$plantilla->printToScreen();




?>