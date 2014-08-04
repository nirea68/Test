<?php

/**
 * Sistema
 * 
 * @author Pablo Camilli
 * @version 2014
 * @access public
 */
 
 
require_once("ConexionBD.php");
require_once("Usuario.php");
require_once("Producto.php");
require_once("Presupuesto.php");
require_once("Configuracion.php");


class Sistema extends ConexionBD {


 $listadoProductos;


  public function getListadoProductos() {
	return $this->listadoProductos ;
	}


	
  public function agregarProducto($unProducto) {
    
   $this->listadoProductos[ $unProducto->getIdProducto()] = $unProducto ;
    
	}
   
    	
      // singleton instance
  static   $instance;

   function __construct() {
    
    $this->listadoProductos = array();
    $this->cargarProductos();
      
  }


  // Metodo de instancia
  public static function Negocio() {

    if(!self::$instance) { self::$instance = new self();}

    return self::$instance;

  }


//Devuelve un objeto producto correspondiente al id pasado por parametro

public function obtenerProdPorID( $idProducto)
{

$listaProductos = $this->getListadoProductos();

    return $listaProductos[$idProducto];

}



//Verifica las credeciales de usuario y permite el acceso a secciones restringidas


public function autenticarUsuario( $nombreUsuario , $password){


$usuarioRetorno = null;

$salt = "$5AFs@xaNl*kjGet!hd3aX4h2B5@lgjV$";

$passwordSha = $this->encriptarSHA256($password, $salt);

$sentencia = "SELECT * FROM usuarios WHERE usuUsuario = ? AND usuPassword = ? AND usuActivo = 1 LIMIT 1";

$resultado = $this->ejecutarSelectPreparadoSQL($sentencia, array('ss', $nombreUsuario, $passwordSha ));

$config = new Configuracion();


		if( count($resultado) == 1 ) 
        {
            
            $usuarioRetorno = new Usuario();

            $usuarioRetorno->setNombre( $resultado[0]['UsuNombre'] ); 
            $usuarioRetorno->setApellido($resultado[0]["UsuApellido"]); 
            $usuarioRetorno->setFechaIngreso($resultado[0]["UsuFechaIng"]); 
            $usuarioRetorno->setEmail($resultado[0]["UsuEmail"]); 

//
		}else if( $nombreUsuario == $config->getUsuarioSistema() && $password = $config->getClaveSistema())
        {
            $usuarioRetorno = new Usuario();          
            $usuarioRetorno->setNombre( "Usuario por Defecto" );
            
        }
        
        
return $usuarioRetorno;       
        
        
}

//Devuelve el listado de productos que están activos en el sistema(no fueron eliminados)

  public function getListadoProductosActivos() {
	
    
    $listaProductos = array();

    $sentencia = "select * From productos where prdactivo = 1";
    
    $resultado =  $this->ejecutarSelectSinParams($sentencia);


		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {

            $producto = new Producto( $resultado[$fila]["PrdIdProducto"],$resultado[$fila]["PrdNombre"],$resultado[$fila]["PrdDescripcion"], 
            $resultado[$fila]["PrdPrecioUnit"], $resultado[$fila]["PrdImagen"],  $resultado[$fila]["PrdFechaAlta"] );
             
            array_push($listaProductos ,$producto);
              
            }           
            
		}
    
    return $listaProductos;
    
	}
    


//Carga los todos los productos activos en una variable de clase para simplificar operaciones.

public function cargarProductos(){

  $this->listadoProductos = array();

    $sentencia = "select PrdIdProducto, PrdNombre, PrdDescripcion,PrdPrecioUnit,PrdFechaAlta,PrdImagen From productos";
    
    $resultado =  $this->ejecutarSelectSinParams($sentencia);


		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {

            $producto = new Producto( $resultado[$fila]["PrdIdProducto"],$resultado[$fila]["PrdNombre"],$resultado[$fila]["PrdDescripcion"], 
            $resultado[$fila]["PrdPrecioUnit"], $resultado[$fila]["PrdImagen"],  $resultado[$fila]["PrdFechaAlta"] );
             
             $this->agregarProducto($producto);
              
            }           
            
		}
  
          
}


public function inactivarProducto($idProducto)
{

   $sql = "UPDATE `productos` SET PrdActivo = 0
    WHERE PrdIdProducto = ?  ;";
  
    $parametros = array("i", $idProducto );
    
    $retorno = $this->ejecutarDMLPreparadoSQL($sql,$parametros);
    
   return $retorno ;
   
    
}


//Devuelve un objeto presupuesto en formato json

 public function ObtenerJsonPresupuestoPorId($unIdPresupuesto)
 {
    
$jsonstring = "";
 
$unPresupuesto = new Presupuesto();

 $sql = "SELECT * FROM `presupuestos` where PreIdPresupuesto = ? and preestaprocesado = 0;";


    if( $resultado = $this->ejecutarSelectPreparadoSQL($sql,array('i', $unIdPresupuesto) ) )
    {
        
        
		if( count($resultado) == 1 )
        {
            
            $fila = 0;
             
             $unPresupuesto = new Presupuesto( $resultado[$fila]["PreIdPresupuesto"],$resultado[$fila]["PreNombreSolicitante"],
             $resultado[$fila]["PreTelefonoSolicitante"], $resultado[$fila]["PreEmailSolicitante"], $resultado[$fila][						             "PreFechaIngreso"],
             $resultado[$fila]["PreCantidadPersonas"]);
            
             $unPresupuesto->CargarListaItems();
             
             $arrayItems = array();
             $items = array();
             
			 foreach( $unPresupuesto->getListaItems() as $item)
             {
                
               $items["Cantidad"] = $item->getCantidad();
               $items["IdProd"] =$item->getProducto()->getIdProducto();
               $items["NombreProd"] =$item->getProducto()->getNombre();
               $items["Precio"] = $item->getPrecio();
               
               array_push( $arrayItems, $items);
               
             }
             
             $arrayRetorno = array( "IdPresupuesto" => $resultado[$fila]["PreIdPresupuesto"],
             
            "NombreSolicitante" => $resultado[$fila]["PreNombreSolicitante"],
            "TelefonoSolicitante" => $resultado[$fila]["PreTelefonoSolicitante"], 
            "EmailSolicitante" => $resultado[$fila]["PreEmailSolicitante"], 
            "FechaIngreso" => $resultado[$fila]["PreFechaIngreso"],
            "CantidadPersonas" => $resultado[$fila]["PreCantidadPersonas"],
            "ListaItems" => $arrayItems
             );
 
            
 $jsonstring = json_encode(  $arrayRetorno );

            }
        
    }

 return $jsonstring;
    
 }
 


//Este metodo marca como procesado un presupuesto ya revisado.

function procesarPresupuesto( $idPresupuesto)
{
    
   $sql = "UPDATE `presupuestos` SET PreEstaProcesado = 1, PreFechaProcesamiento = ?
    WHERE PreIdPresupuesto = ?  ;";
        
    $date = new DateTime(date('Y-m-d H:i:s'));
    $fechaResultado = $date->format('Y-m-d H:i:s');
    
    
    $parametros = array("si",$fechaResultado, $idPresupuesto );
    
    $retorno = $this->ejecutarDMLPreparadoSQL($sql,$parametros);
    
   return $retorno ;


}


 
 public function ObtenerListaPresupuestosSinProcesar()
 {
 
 $listaPresupuestos = array();
 
 $sql = "SELECT * FROM `presupuestos` where preestaprocesado = 0";


if( $resultado = $this->ejecutarSelectSinParams($sql) )
{

		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {
             
             $unPresupuesto = new Presupuesto( $resultado[$fila]["PreIdPresupuesto"],$resultado[$fila]["PreNombreSolicitante"],
             $resultado[$fila]["PreTelefonoSolicitante"], $resultado[$fila]["PreEmailSolicitante"], $resultado[$fila][						             "PreFechaIngreso"],
             $resultado[$fila]["PreCantidadPersonas"]);
            
             $unPresupuesto->CargarListaItems();
			 
			array_push( $listaPresupuestos,$unPresupuesto);

            
            }
  

		}
        
}

return $listaPresupuestos;
  
    
 }
 
 
 
 //Devuelve el top 5 de productos mas vendidos
 
public function getListadoProductosMasVendidos()
{
	
	 $listaProductos = array();
	 
	  $sql = "SELECT`PrdIdProducto`, COUNT(*) as 'Cantidad' 
				FROM  `items_presupuestos` 
				group by `items_presupuestos`.`PrdIdProducto`
				ORDER BY  2 DESC
				limit 5";

if( $resultado = $this->ejecutarSelectSinParams($sql) )
{
	
		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {
				
				array_push( $listaProductos, $this->obtenerProdPorID( $resultado[$fila]["PrdIdProducto"]));
				array_push( $listaProductos, $resultado[$fila]["Cantidad"] );
			}
			
		}
		
		return $listaProductos;
	
}
 
}
 
  //Devuelve el top 5 de productos menos vendidos
 
 public function obtenerCantidadPedidosProcesados()
 {
    
     $cantidad= 0;
	 
	  $sql = "SELECT COUNT(*) as 'Cantidad' 
				FROM  `presupuestos` 
				where preEstaProcesado = 1;";

    if( $resultado = $this->ejecutarSelectSinParams($sql) )
    {
        
        if( count($resultado) == 1 ) 
            {
                 $cantidad = $resultado[0]["Cantidad"];
        
            }
    }

 return $cantidad;

 }
 
 
 public function obtenerCantidadPedidosPendientes()
 {
    
     $cantidad= 0;
	 
	  $sql = "SELECT COUNT(*) as 'Cantidad' 
				FROM  `presupuestos` 
				where preEstaProcesado = 0;";

    if( $resultado = $this->ejecutarSelectSinParams($sql) )
    {
        
        if( count($resultado) == 1 ) 
            {
                 $cantidad = $resultado[0]["Cantidad"];
        
            }
    }

 return $cantidad;

 }
 
 
 
 
 public function getListadoProductosMenosVendidos()
{
	
	 $listaProductos = array();
	 
	  $sql = "SELECT`PrdIdProducto`, COUNT(*) as 'Cantidad' 
				FROM  `items_presupuestos` 
				group by `items_presupuestos`.`PrdIdProducto`
				ORDER BY  2 ASC
				limit 5";

if( $resultado = $this->ejecutarSelectSinParams($sql) )
{
	
		if( count($resultado) >= 1 ) 
        {
            
            for ( $fila = 0; $fila < count($resultado); $fila++)
            {
				
				array_push( $listaProductos, $this->obtenerProdPorID( $resultado[$fila]["PrdIdProducto"]));
				array_push( $listaProductos, $resultado[$fila]["Cantidad"] );
			}
			
		}
		
		return $listaProductos;
	
}
 
}

        
public function encriptarSHA256( $unTexto, $salt)
{
    return hash("sha256", $unTexto + $salt);
}



public function validarEmail($unEmail)
{
    $retorno = false;
    
    if ( filter_var($unEmail, FILTER_VALIDATE_EMAIL)) 
    {
       $retorno = true;
    }
    
    return $retorno;
    
}



public function validarEntero($unNumero)
{
    $retorno = false;
    
    if ( $unNumero && is_int((int)$unNumero)) 
    {
       $retorno = true;
    }
    
    return $retorno;
    
}

//Verifica que el dato ingresado sea un float no nulo

public function validarDecimal($unDecimal)
{
    $retorno = false;
    
    if ( $unDecimal && is_float( (float)$unDecimal) )
    {
       $retorno = true;
    }
    
    return $retorno;
    
}

//Verifica que el dato ingresado sea un string no nulo

public function validarString($unString)
{
    $retorno = false;
    
    if ($unString && is_string($unString) ) 
    {
       $retorno = true;
    }
    
    return $retorno;
    
}


//Este metodo se encarga de quitar los caracteres raros o tags que puedan introducirse malintencionadamente

public function AsegurarEntradas($entrada)
{
    $retorno = '';
    
   if($entrada)
   {
     
    $retorno = htmlspecialchars($entrada);
    
   }
  
  return $retorno;
  
}



     
}

?>