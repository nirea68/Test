$(document).ready(function () {

    //Variables generales

    var presupuesto = new Array();
    var subtotalPorPers = 0;

    $('.bloqueo').hide();
    $(".exito").hide();

    //Carga los productos seleccionados en un array
    //Muestra los items en la vista previa del pedido
    //Calcula el subtotal por item y persona

    $("ul.productos form").submit(function (eve) {

        var arrCampos = $(this).serializeArray();

        var arrResultado = {};

        var nuevaFilaPresupuesto = "<tr>";
        var nuevaFilaResumen = "<tr>";

        $.each(arrCampos, function (i, arrCampos) {

            nuevaFilaPresupuesto += "<td>" + arrCampos.value + "</td>";
            nuevaFilaResumen += "<td>" + arrCampos.value + "</td>";
            arrResultado[arrCampos.name] = arrCampos.value;

        });

        var subtotal = parseFloat(arrResultado["precio"]) * parseInt(arrResultado["cantidad"]);

        subtotalPorPers += parseFloat(subtotal);

        nuevaFilaPresupuesto += "<td>" + subtotal + "</td>";

        nuevaFilaResumen += "<td>" + subtotal + "</td>";

        arrResultado["subtotal"] = parseFloat(subtotal);

        nuevaFilaPresupuesto += "</tr>";
        nuevaFilaResumen += "</tr>";

        $("#SpamSubto h6").empty();

        $("#SpamSubto h6").append(subtotalPorPers);

        $("#NoItems").remove();

        $("#presupuesto").append(nuevaFilaPresupuesto);

        $("#lista_Items").append(nuevaFilaResumen);

        presupuesto.push(arrResultado);

        $(".exito").show();

        $(".exito").fadeOut(1500);

        eve.preventDefault();
        return false;

    });



    //Valida que exista item, y si es correcto muestra un formulario con el resumen del presupuesto

    $("#FormCantPers").submit(function (e) {

        if (presupuesto.length != 0) {

            var cantidad = $("#cantPers").val();

            $("#hdnCantPers").val(cantidad);

            $("#cantPerso h5").empty();

            $("#cantPerso h5").append(cantidad);

            $("#subtotPre h5").empty();

            $("#subtotPre h5").append(subtotalPorPers * parseInt(cantidad));

            $('.bloqueo').show();

        }
        else {

            alert("Debes seleccionar al menos un producto para poder continuar.");
        }

        e.preventDefault();
        return false;

    });



    $('.cerrar_formulario_modal').click(function () {

        $('.bloqueo').fadeOut(300);

        return false;
    });


    //Envia los datos del pedido al servidor

    $('#EnviarPedido').submit(function (eve) {

        //Guardo todos los campos del form en un array
        var arrCampos = $(this).serializeArray();

        var arrResultado = {};

        //Toma todos los elementos del formulario y los agrega a un array asociativo 
        
        $.each(arrCampos, function (i, arrCampos) {

            arrResultado[arrCampos.name] = arrCampos.value;

        });
        
        //Agrego el array asociativo al que ya tenia con los items

        presupuesto.push(arrResultado);


        //serializo el array a fto Json
        var datosPost = JSON.stringify(presupuesto);

        //creo un string del tipo form encoded
        datosPost = "datosJson=" + datosPost;

        //Envio los datos al servidor
        $.ajax({
            type: "POST",
            url: "Controladores/Presupuesto_Control.php",
            dataType: "html",
            data: datosPost,
            success: function (datos) {

            if(datos == 1)
            {
                $('.bloqueo').hide();
                alert('Solicitud enviada correctamente, en breve nos pondremos en contacto.');
                location.reload();
            }else
            {
                $('.bloqueo').hide();
                alert('Ha ocurrido un error al enviar su solicitud');
                location.reload();
                
            }
            
            },
            error: function (e) {

                alert("ha ocurrido un error " + e.message);

            }

        });

        return false;


    });

    //Borra el pedido al hacer reload se inicializa todo nuevamente.

    $("#resetPre").click(function () {

        location.reload();

    });


});