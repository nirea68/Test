<?php  



/**
* ConexionBD
* 
* @package   
* @author sitio fashion
* @copyright Pcamilli
* @version 2014
* @access public
*/



require_once("Configuracion.php");


class ConexionBD{  


 $idRegInsertado;


public function getIdRegInsertado()
{
    return $this->idRegInsertado;
    
}

public function setIdRegInsertado($unId)
{
    $this->idRegInsertado = $unId ;
    
}


public function  __construct()
{  

    $this->setIdRegInsertado(0);
	

} 



function establcerConexionBD()
{  

    $config = new Configuracion();
    

		$servidor = $config->getHost() . ":" . $config->getPuerto();
		  
		$linkConexionBD =   new mysqli($servidor, $config->getUsuario(), $config->getClave(),$config->getBaseDatos()) ;
		
			if ($linkConexionBD->connect_errno) 
			{
				echo "Falló la conexión a la Base Datos " . $linkConexionBD->connect_error;

			} 
		 
       return  $linkConexionBD;
   

}



public function ejecutarSelectSinParams($unaInstruccion){  

$listaResultado  = array();

$conexion = $this->establcerConexionBD();


if( $conexion)
{   
    	if( ! $resultado = $conexion->query($unaInstruccion)){  
    
		echo ' Error al ejecutar consulta : ' . $resultado->error;  
		
		} else
		{
			
			while($fila = $resultado->fetch_assoc()) {
						
			array_push($listaResultado,$fila);
		}
		
		//cierro la conexion con la BD y destruyo el objeto

		$conexion->close();

    }


}

return $listaResultado;


}



public function ejecutarDMLPreparadoSQL( $sql, $arrayParam){
    
$retorno = true;

//Abro la conexion con la BD

$conexion = $this->establcerConexionBD();

//Esta linea hace la preparacion de la consulta (revisa que este bien formulado el string)

if( ! $sentencia = $conexion->prepare($sql) )
{

    echo "Falló al preparar la instruccion!" . $conexion->error ;
    
    $retorno = false;

}

//Llamo a la funcion bind_param con la funcion call_user_func_array para poder pasarle de forma dinamica un array de parametros
//La funcion bind_param se encarga de "sustituir" los ? por cada uno de los parametros pasados en el array en orden de izq a derecha


if($arrayParam && $retorno )
{

 call_user_func_array(array($sentencia, 'bind_param'), $this->makeValuesReferenced($arrayParam) );
        
}

//Una vez preparada la sentencia el comando execute realiza la consulta sobre la BD

 if ($sentencia->execute() && $retorno)
 {
    
    $this->setIdRegInsertado( $sentencia->insert_id);
  

}else
{
    
  echo "Error en la ejecución: (" . $conexion->errno . ") " . $conexion->error;

    $retorno = false;
}


  //cierro la conexion con la BD
    $conexion->close(); 
  
return $retorno;


}




/*


*/



public function ejecutarSelectPreparadoSQL( $sql, $arrayParam){

$retorno = null;
$output = array();
$count = 0;


//Abro la conexion con la BD

$conexion = $this->establcerConexionBD();

//si la conexion se estableció se continua con la ejecución
if($conexion)
{ 

	//Esta linea hace la preparacion de la consulta (revisa que este bien formulado el string)

	if($sentencia = $conexion->prepare($sql))
	{
	
	//Llamo a la funcion bind_param con la funcion call_user_func_array para poder pasarle de forma dinamica un array de parametros
	//La funcion bind_param se encarga de "sustituir" los ? por cada uno de los parametros pasados en el array en orden de izq a 	    derecha
	
		
	 call_user_func_array(array($sentencia, 'bind_param'), $this->makeValuesReferenced($arrayParam));
	
	//Una vez preparada la sentencia el comando execute realiza la consulta sobre la BD
	$sentencia->execute();
	
	
	//Si la sentencia se ejecuto correctamente voy a tener el buffer con los datos resultantes
	// y tengo que hacer una serie de operaciones para retornar un array asociativo
	
			 $metadata = $sentencia->result_metadata();
			   $out = array();
			   $fields = array();
			   if (!$metadata)
				   return null;
			   $length = 0;
			   
			   while (null != ($field = mysqli_fetch_field($metadata))) {
				   
				   $fields [] = &$out [$field->name];
				   
				   $length+=$field->length;
			   }
			   
			   
			   call_user_func_array(array($sentencia, "bind_result"), $fields);
			 
			  			  
		  while ($sentencia->fetch())
		  {
						
				foreach( $out as $key=>$value )
				{
					$row_tmb[ $key ] = $value;
				}
			
			  $retorno[] = $row_tmb;
			 
			}
				  
		   $sentencia->free_result();
		   
		   $conexion->close();
		   
	}else
    {
        
        echo "Falló al preparar la instruccion sql!";
    }

}else
    {
        
        echo "Fallo al establecer conexion";
    }

    return $retorno;
  
} 


function makeValuesReferenced($arr){
    $refs = array();
    foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
    return $refs;

}



function totalFilas($resultado){   

return $resultado->numRows();

}	


function ultimoIdInsertado(){

return mysqlli_insert_id();

}





}

?> 