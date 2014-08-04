<?php

/**
 * @author Pcamilli
 * @copyright 2014
 */



 require_once("../core/Sistema.php");
 require_once("../core/Presupuesto.php");
 require_once("../core/Item.php");
 require_once("../core/Producto.php");


$negocio = Sistema::Negocio();

$idProducto  = $_POST["idProd"];	
$NombreProducto  = $_POST["nombre"];
$DescripcionProd = $_POST["descripcion"];
$PrecioProducto	= $_POST["precio"];
$nombreImagen	= $_POST["nombreImagen"];



$uploaddir = '../ImgProductos/';
    

$extensionesPermitidas = array("jpeg", "jpg", "png");

$temp = explode(".", $_FILES["imgProducto"]["name"]);

$extension = end($temp);

$idUnico = date("YmdHis");

$retorno = 0;



   
      
if($negocio->validarString($NombreProducto)&& $negocio->validarString($DescripcionProd)
 && $negocio->validarDecimal($PrecioProducto) )
 {
             $producto = new Producto(0, $NombreProducto, $DescripcionProd , $PrecioProducto);
      
                $producto->setIdProducto($idProducto);
                
      if($_FILES['imgProducto']['tmp_name']=="")
        {
              $producto->ActualizarDatos();  
              $negocio->cargarProductos();
              $retorno = 1;
                 
        }else{
            
            
            
if (( ($_FILES["imgProducto"]["type"] == "image/jpeg") 
|| ($_FILES["imgProducto"]["type"] == "image/jpg") 
|| ($_FILES["imgProducto"]["type"] == "image/pjpeg")
|| ($_FILES["imgProducto"]["type"] == "image/x-png") 
|| ($_FILES["imgProducto"]["type"] == "image/png")) 
&& ($_FILES["imgProducto"]["size"] < 2000000) && in_array($extension, $extensionesPermitidas))
  {
    
  if ($_FILES["imgProducto"]["error"] > 0)
    {
    echo "Codigo Error: " . $_FILES["imgProducto"]["error"] ;
    }
    else
    {
        
    //Borro la foto actual del servidor
     unlink($uploaddir. $nombreImagen);


    //Cargo la nueva imagen
        
    if ( ! file_exists($uploaddir . $idUnico . $_FILES["imgProducto"]["name"]))
      {
       
      move_uploaded_file($_FILES["imgProducto"]["tmp_name"], $uploaddir. $idUnico . $_FILES["imgProducto"]["name"]);
 
      $ImagenProducto= $idUnico . $_FILES["imgProducto"]["name"];
      
      $producto->setUrlImg($ImagenProducto);
      
      $producto->ActualizarDatos(); 
      $producto->ActualizarImagen();  
      $negocio->cargarProductos();
      $retorno = 1;
      
      }
      

    }
    
            
}
          
}
}


echo $retorno;

?>