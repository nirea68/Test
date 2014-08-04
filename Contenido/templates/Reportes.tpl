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
        <li id="mnuProductos" ><a href="ListadoProductos.php">Productos</a></li>
        <li id="mnuReportes" class="active"><a href="Reportes.php">Reportes</a></li>           
    </ul>

</div>



<div id="divLoading" class="cargando" >
    
    <div id="espere">

        <p style="position: absolute; top: 21%; left: 30.7%; color: White">
            <img width="120" height="120" src="../contenido/Imagenes/Loader.gif" alt="" />
            <br /><br />Procesando solicitud...
        </p>

    </div>

</div>


<div class="contenido">

<ul id="listaResultadosRpt">

<li>
<h3>Cinco Productos mas vendidos:</h3>

<table id="lista-productosMas">
<tr>
<th>ID Producto</th>
<th>Nombre</th>
<th>Cantidad</th>

</tr>

<!-- START BLOCK : ProductosMas -->

<tr>
<td>{IdProducto}</td>
<td>{NombreProd}</td>
<td>{Cantidad}</td>

</tr>

<!-- END BLOCK : ProductosMas -->


</table>

</li>
<li>
<h3>Cinco Productos menos vendidos:</h3>


<table id="lista-productosMenos">
<tr>
<th>ID Producto</th>
<th>Nombre</th>
<th>Cantidad</th>

</tr>

<!-- START BLOCK : ProductosMenos -->

<tr>
<td>{IdProducto}</td>
<td>{NombreProd}</td>
<td>{Cantidad}</td>

</tr>

<!-- END BLOCK : ProductosMenos -->


</table>
</li>
<li>
<h3>Cantidad Presupuestos Procesados:</h3>
<span>{CantidadProcesados}</span>
</li>
<li>
<h3>Cantidad Presupuestos Pendientes de Procesar:</h3>
<span>{CantidadPendientes}</span>
</li>
</ul>


</div>

</div>

</body>
</html>