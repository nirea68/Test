<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="content-type" content="text/html" />
<meta name="author" content="Pcamilli" />

    <title>::Swit Admin::</title>


<link rel="stylesheet" href="../contenido/css/Estilos.css" type="text/css" />
<link rel="stylesheet" href="../contenido/css/EstilosFormLogin.css" type="text/css" />

<script type="text/javascript" src="../contenido/js/jquery-1.8.3.js"></script>


<script type="text/javascript">

$(document).ready(function(){
	
   $("#login").click(function(){
    
		nombreUsuario= $("#usuario").val();
        password= $("#password").val();

         $.ajax({
           type: "POST",
           url: "../controladores/login_control.php",
           data: "usuario="+nombreUsuario+"&password="+password,
           success: function(datos){
            
                var resp = parseInt(datos );
                
			  if(resp == 1)
              {
                
                $("#login_form").fadeOut("slow");

                document.location.href = "ListadoPresupuestos.php";
                                
              }
              else if(resp != 1)
              {
                    $("#mostrar_error").html("Usuario o clave incorrectos");
              }
              
            },
            beforeSend:function()
			{
                 $("#add_err").html("Loading...")
            }
        });
        
        
         return false;
    });
});

</script>


</head>

<body>


<div class="container" id="login_form">

<section id="content">


<form method="Post" action="login.php">

<h1>Acceso al Sistema</h1>
<div>
<input type="text" class="usuario" placeholder="Usuario" required="" id="usuario"  name="Usuario"/>
</div>
<div>
<input type="password" class="clave" placeholder="Contraseña" required="" id="password"  name="Password"/>
</div>
<div class="err" id="mostrar_error"></div>
<div>
<input type="submit" value="Entrar" id="login"  />

</div>

</form>

</section>

</div>


</body>
</html>