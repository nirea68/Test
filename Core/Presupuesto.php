<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */


require_once("ConexionBD.php");
require_once("Item.php");
require_once("Producto.php"); 

// se van a hacer llamadas duplicadas a conexion pero once las previene

class Presupuesto extends ConexionBD{

 $idPresupuesto;
 $nombreSolicitante;
 $telefonoSolicitante;
 $emailSolicitante;
 $fecha;

 $listaItems;
 $totalPersonas;


public function getIdPresupuesto()
{
return $this->idPresupuesto;
}
public function setIdPresupuesto( $unId)
{
  $this->idPresupuesto = $unId;
}
  
public function getNombreSolicitante()
{
return $this->nombreSolicitante;
}
public function setNombreSolicitante( $unNombre)
{
  $this->nombreSolicitante = $unNombre;
}
public function getTelefonoSolicitante()
{
return $this->telefonoSolicitante;
}
public function setTelefonoSolicitante( $unTelefono)
{
  $this->telefonoSolicitante= $unTelefono;
}
public function getEmailSolicitante()
{
return $this->emailSolicitante;
}

public function setEmailSolicitante( $unEmail)
{
  $this->emailSolicitante = $unEmail;
}

public function getFecha()
{
return $this->fecha;
}

public function setFecha( $unaFecha)
{
  $this->fecha = $unaFecha;
}
 

public function getListaItems()
{
return $this->listaItems;
}
 

public function getTotalPersonas()
{
return $this->totalPersonas;
}

public function setTotalPersonas( $unTotalPersonas)
{
  $this->totalPersonas = $unTotalPersonas;
}


public function agregarItem( $unItem)
{
 array_push($this->listaItems,$unItem);
}
 

public function __construct( $unId = 0,$unNombre= "unNombre",$unTelefono = "000000000",$unEmail = "default@def.com", $unaFecha = "1900-01-01", $unaCantidadPers = 0){

$this->setIdPresupuesto($unId);
$this->setNombreSolicitante($unNombre);
$this->setTelefonoSolicitante($unTelefono);
$this->setEmailSolicitante($unEmail);
$this->setFecha($unaFecha);
$this->setTotalPersonas($unaCantidadPers);
$this->listaItems = array();

}


public function obtenerImporteTotalPresupuesto()
{
    $sumatotal = 0;
    
     foreach ( $this->getListaItems() as $item ) {
        
       $sumatotal = $sumatotal + ($item->getCantidad() * $item->getProducto()->getPrecioUnitario());
     }

    return $sumatotal;
}



public function obtenerCantidadItemsPresupuesto()
{
    return count(getListaItems());
}
 
 
 
 public function guardarPresupuesto()
 {
    
$retorno = false;
    
$sql = "INSERT INTO `presupuestos` (
`PreCantidadPersonas`,
`PreNombreSolicitante`, 
`PreTelefonoSolicitante`, 
`PreEmailSolicitante`,
`PreFechaIngreso`, 
`PreEstaProcesado`) 
VALUES (? , ?, ? , ?, ? , ?)";


$date = new DateTime(date('Y-m-d H:i:s'));
$result = $date->format('Y-m-d H:i:s');


$parametros = array("issssi",
$this->getTotalPersonas(),$this->getNombreSolicitante(),
$this->getTelefonoSolicitante(),$this->getEmailSolicitante(), $result , 0 );

$this->ejecutarDMLPreparadoSQL($sql,$parametros);

$idPresupuesto = $this->getIdRegInsertado();


    if($idPresupuesto && $idPresupuesto != 0)
    {   
		$retorno = true;
		
         foreach ( $this->getListaItems() as $item ) {
            
           $item->guardarItem( $idPresupuesto);
           
           unset($item);    
         }
         
    }

return $retorno;

}
 
 
 
 public function CargarListaItems()
 {
    
 $negocio = Sistema::Negocio();
    
 $sql = 'SELECT * FROM `items_presupuestos` WHERE PreIdPresupuesto = ? ';
    
 $resultado = $this->ejecutarSelectPreparadoSQL($sql,array("i",$this->getIdPresupuesto()));


		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {
                $unProducto = new Producto();
                
                $item = new Item( $unProducto, 0);
                
                $unProducto = $negocio->obtenerProdPorID($resultado[$fila]["PrdIdProducto"]);
                             
                $item->setCantidad( $resultado[$fila]['ItmCantidad'] );
                $item->setProducto($unProducto);
                $item->setPrecio($resultado[$fila]['ItmPrecioUnit']  );
    
                $this->agregarItem($item);
    
                unset($unProducto);         
                unset($item);
            }

		}
        
    
 }
 
 
}


?>