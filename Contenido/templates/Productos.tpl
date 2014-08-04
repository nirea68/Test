 <!DOCTYPE HTML>
<html>
<head>

    <meta charset="iso-8859-1" />
	<meta name="author" content="pcamilli" />

	<title>:: Swit ::</title>
    
    <link rel="stylesheet" href="Contenido/css/Estilos.css"/>    
    <link rel="stylesheet" href="Contenido/css/Productos.css"/>
    
	<script  src="Contenido/js/jquery-1.8.3.js"></script>
	<script  src="Contenido/js/Scripts_Productos.js"></script>
    
    </head><body> 
    
  <header>
  

    <div class="shell">
    
     <div id="logo"><a href="index.php"></a></div>
            
      <div class="limpiar">&nbsp;</div>

      
      <nav id="navigation">
        <ul>
          <li><a href="Index.php">Inicio</a></li>
          <li><a href="Productos.php">Menú</a></li>
          <li><a href="#">Contáctenos</a></li>
        </ul>
      </nav>

    </div>

  </header>

  <div class="main">
  <div id="contenido_principal">
  
  <div class="bloqueo">
    
    <div class="formulario_modal"><a href="" class="cerrar_formulario_modal"></a>
               
        <div class="contenido_formulario">
        
        <h2>Resumen Presupuesto:</h2>

            <div class="contenedor_tabla_items">
            
                <table id="lista_Items" class="table"> 
                <tr>
                <th>Id</th>
                <th>Cantidad</th>
                <th>Producto</th>            
                <th>Precio</th>
                <th>Subtotal</th>
                </tr>
                
                </table>

             
            </div>
            
          
            <div class="form_envio_resumen">
                
                <form id="EnviarPedido">    
                <fieldset>
                
                <ul>
                <li>       
                <input name="cantidadPersonas" type="hidden" value="0" id="hdnCantPers" />
                <input type="text" placeholder="Nombre" name="nombreSolicitante" required="required"  title="Debes ingresar un nombre" />
                </li><li>
                <input type="email"  placeholder="E-mail" name="email" required="required"  title="Debes ingresar un email válido"/>
                </li><li>
                <input type="text"  placeholder="Teléfono" name="telefono" required="required" title="Debes ingresar un telefono"/>
                </li><li>
                <input type="submit" value="Enviar" class="botonEnviarPedido" />
                </li>
                </ul>
                </fieldset>            
                </form>
  
            </div>
        
          <div class="limpiar">&nbsp;</div>
          
          <div id="cantPerso">Cantidad Personas:<h5></h5></div>         
          <div id="subtotPre">Subtotal Presupuesto:$<h5></h5></div>         
          
      
        
        </div>
    
    </div>
			 
</div>

<!-- START BLOCK : Productos -->

<ul class='productos'> 
<li> 

<h3>{NombreProd}</h3>
<img class="ImgProd" src="ImgProductos/{ImgProd}" alt="Imagen Producto"/>
<small>Precio {PrecioProd} </small>
<h5>{DescProd}</h5>

<form> 
<fieldset>
<label>Cantidad x Pers.</label> 

<select name='cantidad' class='combo'>

<!-- START BLOCK : select -->

<option value='{Numero}'> {Numero} </option>

<!-- END BLOCK : select -->

</select>
<input type='hidden' name='id' value='{IdProd}' /> 
<input type='hidden' name='nombre' value='{HiddNombreProd}' /> 
<input type='hidden' name='precio' value='{HiddPrecioProd}' /> 
<input type='submit' name='boton' value='Agregar'/>
</fieldset></form></li></ul> 

<!-- END BLOCK : Productos -->



</div>

<div class="exito">Se agregó correctamente el item</div>

<div id="contenedor_presupuesto">

<a id="resetPre">Borrar Presupuesto</a>


<table id="presupuesto"> 

<tr id="titulosTabla">
<th>Cantidad</th> <th>Id</th> <th>Nombre</th>  <th>Precio</th><th>Subtotal</th>
</tr>

<tr id="NoItems">

<td colspan="5" >No hay items</td>

</tr>


</table>

<div class="limpiar"></div>

<div id="SpamSubto">Subtotal por persona: $ <h6>0</h6></div></div>

<form id="FormCantPers" action="#" method="Post">

<input type="number" id="cantPers" min="0" step="1"  placeholder="Cantidad Personas (*)" required="required" title="Debes ingresar un numero entero" />

<input type='submit' name='boton' value='Confirmar' />

</form>

          
<div class="limpiar"></div>

</div>   


<div id="footer-push"></div>

<footer>

  <div class="shell">
    <div class="footer-nav">
      <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="productos.php">Menú</a></li>
          <li><a href="#">Contáctenos</a></li>
      </ul>
    </div>
    <p class="copy">Swit Catering 2014</p>
  </div>
</footer>

</body>
</html>