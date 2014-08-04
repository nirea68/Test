<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */
 
 require_once("ConexionBD.php");
 require_once("Producto.php");


class Item extends ConexionBD{


 $producto;
 $cantidad;
 $precio;


public function getProducto()
{
    return $this->producto;
}

public function getPrecio()
{
    return $this->precio;
}

public function setPrecio( $unPrecio)
{
    $this->precio = $unPrecio;
}


public function setProducto($unproducto)
{
    $this->producto = $unproducto;
    
}

public function getCantidad()
{
    return $this->cantidad;
    
}

public function setCantidad($unaCantidad)
{
    $this->cantidad = $unaCantidad;
    
}

public function calcularImporteTotal()
{
  return $this->getCantidad() * $this->getproducto()->getPrecioUnitario();
}
 
 
 public function __construct($unProducto = null,$unaCantidad = 0, $unPrecio = 0)
{
    
    $this->setCantidad( $unaCantidad);
    $this->setProducto( $unProducto);
    $this->setPrecio( $unPrecio);  
}


public function guardarItem($idPresupuesto)
{

 $sql = "INSERT INTO `obligatoriotp2`.`items_presupuestos` ( `PreIdPresupuesto`, `PrdIdProducto`, `itmPrecioUnit`, `itmCantidad`)
    VALUES (?, ?, ?, ?);";
 
 $arrayCampos[0] = "iidi";
 $arrayCampos[1] = $idPresupuesto;
 $arrayCampos[2] = $this->getProducto()->getIdProducto();
 $arrayCampos[3] = $this->getProducto()->getPrecioUnitario();
 $arrayCampos[4] = $this->getCantidad();

 $this->ejecutarDMLPreparadoSQL($sql,$arrayCampos);

    
}


 
}

?>