<?php 


 require_once("../core/Sistema.php");
 require_once("../core/Presupuesto.php");
 require_once("../core/Item.php");
 require_once("../core/Producto.php");


$negocio = Sistema::Negocio();

	
$NombreProducto  = $_POST["nombre"];
$DescripcionProd = $_POST["descripcion"];
$PrecioProducto	= $_POST["precio"];


$uploaddir = '../ImgProductos/';
    

$extensionesPermitidas = array("jpeg", "jpg", "png");

$temp = explode(".", $_FILES["imgProducto"]["name"]);

$extension = end($temp);

$idUnico = date("YmdHis");

$retorno = 0;

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

    if ( ! file_exists($uploaddir . $idUnico . $_FILES["imgProducto"]["name"]))
      {
       
      move_uploaded_file($_FILES["imgProducto"]["tmp_name"], $uploaddir. $idUnico . $_FILES["imgProducto"]["name"]);
 
      $ImagenProducto= $idUnico . $_FILES["imgProducto"]["name"];
      
      $producto = new Producto(0, $NombreProducto, $DescripcionProd , $PrecioProducto, $ImagenProducto);
      

          if($negocio->validarString($NombreProducto)
          && $negocio->validarString($DescripcionProd)
          && $negocio->validarDecimal($PrecioProducto) )
          {
          
              $producto->guardar();
               
              $negocio->cargarProductos();
              
              $retorno = 1;
              
          
          }
    }
    
}

echo $retorno;




?>