
<!DOCTYPE HTML>
<html>
<head>

    <meta charset="iso-8859-1" />
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
        <li id="mnuPresupuestos" class="active"><a href="ListadoPresupuestos.php">Presupuestos</a></li>
        <li id="mnuProductos" ><a href="ListadoProductos.php">Productos</a></li>
        <li id="mnuReportes" ><a href="Reportes.php">Reportes</a></li>           
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


<div class="bloqueo">

<div class="formulario_modal"><a href="" class="cerrar_formulario_modal"></a>

<div class="contenido_formulario">


<ul id="detallePresupuesto">

<li>
<h1>Datos Presupuesto:</h1>
</li>
<li>
<div id="idPresupuesto">Id Presupuesto:<h6></h6></div>
</li>
<li>
<div id="nombreSolic">Nombre:<h6></h6></div>
</li>
<li>
<div id="telSolic">Teléfono:<h6></h6></div>
</li>

<li>
<div id="emailSolic">E-mail:<h6></h6></div>
</li>

<li>
<div id="fechaIngreso">Fecha Ingreso:<h6></h6></div>
</li>

<li>
<div id="cantPers">Cantidad Personas:<h6></h6></div>
</li>

<li>
<table id="ItemsPresupuesto">
<thead>
<tr>
<th>Cantidad</th>
<th>Id Producto</th>
<th>Nombre Producto</th>
<th>Precio</th>
</tr>
</thead> 
<tbody>
</tbody>             
</table>
</li>

<li>
<input type="submit" name="submit" class="btnProcesar" id="ProcesarPresupuesto" value="Procesar" />
</li>
</ul>


</div>

</div>
        
</div>


<div class="contenido">

<div class="exito">Se procesó correctamente el presupuesto</div>

<table class="table table-striped" id="lista-presupuestos">
<thead>
<tr>
<th>ID Presupuesto</th>
<th>Fecha Solicitud</th>
<th>Cantidad Pers.</th>
<th>Importe Total</th>
<th>Solicitante </th>
<th>Telefono</th>
<th>E-mail</th>
<th>Estado</th>
<th>.</th>
<th>.</th>
</tr>
</thead>
<tbody>

<!-- START BLOCK : Presupuestos -->

<tr>
<td>{IdPresupuesto}</td>
<td>{Fecha}</td>
<td>{CantPersonas}</td>
<td>{ImporteTotal}</td>
<td>{Solicitante}</td>
<td>{Tel}</td>
<td>{email}</td>
<td>{estado}</td>
<td><input type="button" value="Ver" class="verPresupuesto" name="{IdPresupuesto}" /> </td>
<td></td>
</tr>

<!-- END BLOCK : Presupuestos -->

</tbody>
</table>



</div>

</div>

</body>
</html>
