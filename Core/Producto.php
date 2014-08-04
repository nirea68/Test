<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */
 
 require_once("ConexionBD.php");

class Producto extends ConexionBD{

     $idProducto;
     $nombre;
     $descripcion;
     $precio_unitario;
     $urlImagen;
     $fechaAlta;
    
    
    public function getIdProducto()
    {
        return $this->idProducto;
    }
    
    public function setIdProducto($unIdProducto)
    {
        $this->idProducto = $unIdProducto;
    }
    
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setNombre($unNombre)
    {
        $this->nombre = $unNombre;
    }
    
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    
    public function setDescripcion($unaDescripcion)
    {
        $this->descripcion = $unaDescripcion;
    }
    
    public function getPrecioUnitario()
    {
        return $this->precio_unitario;
    }
    
    public function setPrecioUnitario($unPrecio)
    {
        $this->precio_unitario = $unPrecio;
    }
    
    public function getUrlImg()
    {
        return $this->urlImagen;
    }
    
    public function setUrlImg($unaUrlImg)
    {
        $this->urlImagen = $unaUrlImg;
    }
    
    
    
    public function getFechaAlta()
    {
        return $this->fechaAlta;
    }
    
    public function setFechaAlta($unaFechaAlta)
    {
        $this->fechaAlta = $unaFechaAlta;
    }
    
    
    
public function __construct($unIdProducto = 0, $unNombre = "unNombre",$unaDescripcion = "unaDesc", $unPrecioUnit = 0.0, $unaUrlImagen = "unaUrl.jpg")
    {
        
        $this->setIdProducto($unIdProducto);
        $this->setNombre ($unNombre);
        $this->setDescripcion($unaDescripcion) ;
        $this->setPrecioUnitario($unPrecioUnit);
        $this->setUrlImg($unaUrlImagen) ;
        $this->setFechaAlta( getdate());
        
    }
    



public function guardar()
{
	
	$retorno = false;
    
	$sql = "INSERT INTO `productos` ( `PrdNombre`,`PrdDescripcion`, `PrdPrecioUnit`, `PrdImagen`,`PrdFechaAlta`, `PrdActivo`) 
	VALUES (? , ?, ? , ?, ? , ?)";
	
	$date = new DateTime(date('Y-m-d H:i:s'));
	
	$fecha = $date->format('Y-m-d H:i:s');
	
	$parametros = array("ssdssi",$this->getNombre(),$this->getDescripcion(),$this->getPrecioUnitario(),$this->getUrlImg(),$fecha,1 );
	
	$this->ejecutarDMLPreparadoSQL($sql,$parametros);
	
}



public function ActualizarDatos()
{
	
	$retorno = false;
    
	$sql = "UPDATE `productos` SET `PrdNombre` = ? ,
    `PrdDescripcion` = ?, `PrdPrecioUnit` = ? 
	where prdidproducto = ? ";
	$parametros = array("ssdi",$this->getNombre(),$this->getDescripcion(),$this->getPrecioUnitario(),$this->getIdProducto() );
	
	$this->ejecutarDMLPreparadoSQL($sql,$parametros);
	
}


public function ActualizarImagen()
{
	
	$retorno = false;
    
	$sql = "UPDATE `productos` SET `PrdImagen` = ? 
    where prdidproducto = ? ";
	
	$parametros = array("si", $this->getUrlImg(),$this->getIdProducto() );
	
	$this->ejecutarDMLPreparadoSQL($sql,$parametros);
	
}

    
}

?>