<?php 

/**
 * @author Pcamilli
 * @version 2014
 * @access public
 */
 
 //Registra todas las configuraciones necesarias del sistema
 
class Configuracion {
    
    
//*** Cambiar estos valores a su propia configuracion ***

 $host       = "localhost";
 $puerto     = 3380;
 $usuario    = "root";
 $clave      = "nirea668";
 $baseDatos  = "obligatoriotp2";

 $usuarioSistema = "Admin";
 $claveSistema   = "1234";



public function getUsuarioSistema(){
	
	return $this->usuarioSistema;
	
}

public function getClaveSistema(){
	
	return $this->claveSistema;
}

public function getHost(){
	
	return $this->host;
	
}
    
public function getUsuario(){
	return $this->usuario;
	}
	
public function getClave(){
	return $this->clave;
	}

public function getBaseDatos(){
	return $this->baseDatos;
	}
	
	
public function getPuerto(){
	return $this->puerto;
	}
		
        
function __construct(){

}



 
}//fin clase


?>