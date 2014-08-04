<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */

/**
 * Usuario
 * 
 * @package   
 * @author sitio fashion
 * @copyright Pcamilli
 * @version 2014
 * @access public
 */
Class Usuario{
    
    
 $nombre;
 $apellido;
 $email;
 $fechaIngreso;

public function getNombre()
{
  return $this->nombre;
}

public function getApellido()
{
  return $this->apellido;
}

public function setNombre($unNombre)
{
 $this->nombre =  $unNombre;
}

public function setApellido($unApellido)
{
  $this->apellido =  $unApellido;
}

public function setEmail($unEmail)
{
     $this->email =  $unEmail;
    
}

public function setFechaIngreso($unaFecha)
{
     $this->fechaIngreso =  $unaFecha;
}



public function __construct(){
  
  $this->setNombre("UnNombre"); 
  $this->setApellido("UnApellido"); 
  $this->setFechaIngreso( getdate());
  $this->setEmail( "defaultEmail");

  
}






    
}


?>