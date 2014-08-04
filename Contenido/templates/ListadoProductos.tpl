
<!DOCTYPE HTML>
<html>
<head>

	<meta name="author" content="Pcamilli" />

    <title>::Swit Admin::</title>

  <link href="../contenido/css/Estilosbackoffice.css" rel="stylesheet" />
  
  <script  src="../Contenido/js/jquery-1.8.3.js"></script>
  
  <script type="text/javascript" src="../contenido/js/Backoffice.js"> </script>
  
</head>

<body>

<div class="principal">

<header>

<div class="logo"><img src="../contenido/imagenes/logo.png" alt="Logo" /></div>

<a href="Salir.php"> Salir </a>

</header>

<div class="limpiar"></div>

<div class="panel-navegacion">

    <ul class="nav navegacion">  
        <li id="mnuPresupuestos" ><a href="ListadoPresupuestos.php">Presupuestos</a></li>
        <li id="mnuProductos" class="active" ><a href="ListadoProductos.php">Productos</a></li>
        <li id="mnuReportes" ><a href="Reportes.php">Reportes</a></li>           
    </ul>

</div>

 
<div class="exito">La operación se realizó exitosamente</div>

<div class="alerta">Debes ingresar una imagen png o jpg </div>  
<div class="msjerror">Ha ocurrido un error por favor vuelve a intentarlo</div>  

<div id="divLoading" class="cargando" >
    
    <div id="espere">

        <p style="position: absolute; top: 21%; left: 30.7%; color: White">
            <img width="120" height="120" src="../contenido/Imagenes/Loader.gif" alt="" />
            <br /><br />Procesando solicitud...
        </p>

    </div>

</div>

<div class="bloqueo">

<div class="formulario_modal"><a href="" class="cerrar_formulario_modal"></a>

<div class="contenido_formulario">

<form id="FormAbmProd" method="POST" enctype="multipart/form-data">

<fieldset><legend></legend>

<ul id="FormProductos">
<li>
<input type="hidden" name="accion" value="1" id="accion" />
<input type="hidden" name="nombreImagen" value="" id="NombreImgHdn" />
<input type="hidden" name="idProd" value="0" id="idProd" />
<input type="text" name="nombre" id="NombreProd" required="required"  placeholder="Nombre Producto (*)" title="Nombre Producto" class="form-nuevoProd" />
</li>
<li>
<textarea name="descripcion" id="DescProd" required="required" placeholder="Descripcion (*)" title="Descripcion" class="form-nuevoProd" ></textarea>
</li>
<li>
<input type="number" min="0" step="0.01"  name="precio" required="required" id="PrecioProd" placeholder="Precio (*)" class="form-nuevoProd" />
</li>
<li>
<div id="contVistaPrevia">
<img id="vistaPrevia" src="#" alt="Vista Previa" />

<div class="contBarraProgreso"><div class="barraProgreso"></div></div>

</div>

<input type="file" name="imgProducto" id="cargarImg" class="form-nuevoProd" />

</li>
<li>
<input type="submit" name="submit" class="btn btnGuardar" id="guardar" value="Guardar" />
<input type="button" value="Eliminar" class="btn btnElimProducto" id=""/> 
</li>
</ul>
</fieldset>
</form>


</div>

</div>
        
</div>


<div class="contenido">

<input type="button" id="NuevoProd" value="Agregar Nuevo" class="Mostrar_formulario_modal" />

<table class="table table-striped" id="lista-productos">
<thead>
<tr>
<th>ID Producto</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Precio</th>
<th> </th>

</tr>
</thead>
<tbody>

<!-- START BLOCK : Productos -->

<tr>
<td>{IdProducto}</td>
<td>{NombreProd}</td>
<td>{DescProd}</td>
<td>{PrecioProd}</td>

<td>
<input type="button" value="Editar" class="ModifProducto"  name="{IdProducto}"/> 
</td>


</tr>

<!-- END BLOCK : Productos -->

</tbody>
</table>


</div>

</div>

</body>
</html>