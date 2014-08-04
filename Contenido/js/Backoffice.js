
$(document).ready(function () {

    var globIdPresupuesto = 0;
    var globIdProducto = 0;
    var globAccion = 0;


    $("#divLoading").hide();
    $('.bloqueo').hide();
    $('.exito').hide();
    $('.alerta').hide();
    $('.msjerror').hide();
    $(".contBarraProgreso").hide();
    $("input[type='button'].btnElimProducto").hide();


    $("input[type='button'].verPresupuesto").on("click", function () {

        var idPresupuesto = $(this).attr("name");

        globIdPresupuesto = idPresupuesto;

        var datosPost = "idPresupuesto=" + idPresupuesto;

        $.ajax({
            type: "POST",
            url: "../Controladores/ObtenerPresupuesto_Control.php",
            data: datosPost,
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function () {

                Procesando();
            },
            success: function (datos) {

                Completo();

                var obj = $.parseJSON(datos);

                $("#idPresupuesto h6").html(obj.IdPresupuesto);
                $("#nombreSolic h6").html(obj.NombreSolicitante);
                $("#telSolic h6").html(obj.TelefonoSolicitante);
                $("#emailSolic h6").html(obj.EmailSolicitante);
                $("#fechaIngreso h6").html(obj.FechaIngreso);
                $("#cantPers h6").html(obj.CantidadPersonas);

                var textoHtml = "<tr class='fila'>";

                $.each(obj.ListaItems, function (i, object) {

                    $.each(object, function (property, value) {

                        textoHtml += "<td>";
                        textoHtml += value;
                        textoHtml += "</td>";

                    });

                    textoHtml += "</tr>";

                });

                $("#ItemsPresupuesto tr.fila").remove();
                $("#ItemsPresupuesto tbody").append(textoHtml);


            },
            error: function (e) {

                Completo();
                alert(e.message);

            }

        });
        $('.bloqueo').show();

        return false;


    });



    $('#ProcesarPresupuesto').click(function (eve) {

        var datosPost = "idPresupuesto=" + globIdPresupuesto;

        $.ajax({
            type: "POST",
            url: "../Controladores/ProcesarPresupuesto_Control.php",
            data: datosPost,
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function () {

                Procesando();
            },

            success: function (datos) {

                $('.bloqueo').hide();
                Completo();

                if (datos == 1) {

                    mostrarMensajeExito();

                    setInterval(function () {
                        location.reload()
                    }, 3000);


                }
                else {
                    alert('ha ocurrido un error por favor vuelva a intentarlo');

                }

            },
            error: function (e) {

                Completo();
                alert(e.message);

            }
        });

        return false;

    });




    //Listado Productos

    //Abre el formulario para editar un producto

    $("input[type='button'].ModifProducto").on('click', function (e) {


        $("input[type='button'].btnElimProducto").show();

        globAccion = 1;

        var altVal = $(this).attr("name");

        globIdProducto = altVal;

        var datosPost = "idProducto=" + altVal;

        $.ajax({
            type: "POST",
            url: "../Controladores/ObtenerProducto_Control.php",
            data: datosPost,
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function () {

                Procesando();
            },
            success: function (datos) {

                Completo();

                var obj = $.parseJSON(datos);

                $("#idProd").val(obj.idProducto);
                $("#NombreProd").val(obj.Nombre);
                $("#DescProd").val(obj.Descripcion);
                $("#PrecioProd").val(obj.Precio);
                $("#NombreImgHdn").val(obj.Imagen);
                $("#vistaPrevia").attr("src", "../ImgProductos/" + obj.Imagen)


            },
            error: function (e) {

                Completo();
                alert(e.message);

            }

        });


        $('.bloqueo').show();

    });



    //Procesa el envío desde el formulario de alta o modificacion,
    //Dependiendo de la accion realiza distintas rutinas

    $('#FormAbmProd').submit(function (eve) {


        if (globAccion == 1) {

            var datosPost = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                url: "../Controladores/ModificarProducto_Control.php",
                data: datosPost,
                beforeSend: function () {

                    Procesando();
                },

                success: function (datos) {

                    Completo();

                    if (datos == 1) {

                        mostrarMensajeExito();

                        alert('Solicitud enviada correctamente');

                        location.reload();
                    }
                    else {
                        alert('Solo se permiten imagenes jpg o png');

                    }

                },
                error: function (e) {

                    Completo();
                    alert(e.message);

                },
                cache: false,
                contentType: false,
                processData: false

            });

        }
        else if (globAccion == 2) {


            var datosPost = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                url: "../Controladores/ListadoProductos_Control.php",
                data: datosPost,
                beforeSend: function () {

                    Procesando();
                },

                success: function (datos) {

                    Completo();

                    if (datos == 1) {

                        mostrarMensajeExito();

                        alert('Producto agregado correctamente');

                        location.reload();
                    }
                    else {
                        alert('Hay un inconveniente, solo se permiten imagenes jpg o png');

                    }

                },
                error: function (e) {

                    Completo();
                    alert(e.message);

                },
                cache: false,
                contentType: false,
                processData: false

            });

        }

        return false;

    });



    //Valida la extensión del archivo subido, muestra una progress bar y si es correcto carga la vista previa

    $("#cargarImg").change(function (eve) {


        var ext = $(this).val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
            alert('invalid extension!');
        }


        $(".contBarraProgreso").show();
        $("#vistaPrevia").hide();

        readURL(this);

        var count = 0;

        var timer = setInterval(function () {

            count += 10;

            if (count >= 100) {

                // Stop repeating
                clearInterval(timer);

                $(".contBarraProgreso").hide();
                $("#vistaPrevia").show();


            } else {
                setProgreso(count);

            }
        }, 100);


    });

    //Elimina logicamente(No se borra el registro de la BD) el producto previamente seleccionado

    $("input[type='button'].btnElimProducto").on("click", function () {

        var datosPost = "idProducto=" + globIdProducto;

        $.ajax({
            type: "POST",
            url: "../Controladores/InactivarProducto_Control.php",
            data: datosPost,
            contentType: "application/x-www-form-urlencoded",
            beforeSend: function () {

                Procesando();
            },
            success: function (datos) {

                Completo();

                if (datos == 1) {

                    alert("Producto eliminado correctamente");
                    location.reload();
                } else {
                    alert("Ha ocurrido un error al eliminar el producto");
                    location.reload();
                }

            },
            error: function (e) {

                Completo();
                alert(e.message);

            }

        });


        return false;

    });


    //Abre el formulario para cargar un nuevo producto

    $("input[type='button'].Mostrar_formulario_modal").on("click", function () {

        globAccion = 2;

        $('.bloqueo').show();

        return false;

    });



    $('.cerrar_formulario_modal').click(function () {

        $('.bloqueo').fadeOut(200);
        location.reload();
        return false;
    });





    //Esta funcion permite un preview de la imagen que se esta subiendo.

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#vistaPrevia').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


    //Hace que la barra de progreso se cargue segun el valor que se pasa por parametro
    function setProgreso(progreso) {
        var barraWidth = progreso * $(".contBarraProgreso").width() / 100;
        $(".barraProgreso").width(barraWidth).html(progreso + "% ");
    }


    function mostrarMensajeExito() {
        $('.exito').show();
        $(".exito").fadeOut(3000);

    }


    //Muestra mensaje en espera
    function Procesando() {
        $("#divLoading").show();
    }

    //Oculta mensaje en espera
    function Completo() {

        $("#divLoading").hide();

    }


});