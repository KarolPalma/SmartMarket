function revisarProducto() {
    //Revisa mediante AJAX que no se trate de insertar un producto ya insertado en esta factura
    var noFactura = document.getElementById("txtNoFactura").value;
    var producto = document.getElementById("cmbProducto").value;
    if (producto == "") {
        alert("Por favor seleccione un producto");
        document.getElementById("cmbProducto").focus();
    } else if (producto.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/facturas/consultaProducto.php',
            data: {
                producto: producto,
                noFactura: noFactura
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Ya esta este producto
                    alert("Ya se inserto este producto para esta factura, por favor eliminelo e inserte la cantidad correcta");
                } else {
                    return revisarExistencias();
                }
            });
    }
    return false
}

function revisarExistencias() {
    //Revisa mediante AJAX que no se trate de insertar una cantidad mayor a la disponible de producto mayor a la existente
    var producto = document.getElementById("cmbProducto").value;
    var cantidad = document.getElementById("txtCantidad").value;
    if (producto == "") {
        alert("Por favor seleccione un producto");
        document.getElementById("cmbProducto").focus();
    } else if (producto.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/facturas/consultaExistencias.php',
            data: {
                producto: producto,
                cantidad: cantidad
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta >= 0) { //Si la resta de producto en el detalle es mayor a la existente pasa a la siguiente validacion
                    return validarDetalle();
                } else {
                    alert("La cantidad de producto ingresada es mayor al número de unidades en existencia en almacen");
                }
            });
    }
    return false
}


function validarDetalle() {
    //Revisa que todos los campos esten correctamente llenados
    if (document.getElementById("cmbProducto").value == "") {
        alert("Por favor seleccione un producto");
        document.getElementById("cmbProducto").focus();
    } else if (document.getElementById("txtCantidad").value == "" || document.getElementById("txtCantidad").value == 0) {
        alert("Por favor ingrese la cantidad de producto llevada");
        document.getElementById("txtCantidad").focus();
    } else if (document.getElementById("cmbDescuento").value == "") {
        alert("Por favor seleccione un descuento válido");
        document.getElementById("cmbDescuento").focus();
    } else if (document.getElementById("cmbImpuesto").value == "") {
        alert("Por favor seleccione un impuesto válido");
        document.getElementById("cmbImpuesto").focus();
    } else { //Si todo esta bien inserta el detalle
        document.getElementById("accion").value = "insertarDetalle";
        document.getElementById("formulario").submit();
    }
    return false;
}


function eliminarDetalle(factura, producto) { //Funcion llamada por el boton de - en cada detalle, crea un popup que pide la autenticacion de un administrador y rellena los campos ocultos en el html, para su eliminacion con php
    var thePrompt = window.open("", "", "widht=500");
    //Incluir librerias de bootstrap
    var theHead = "<meta charset='utf-8'>" +
        "<meta http-equiv='X-UA-Compatible' content='IE=edge'>" +
        "<title>Autentificación - Smart Market</title> " +
        "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>" +
        "<script src='../../js/jquery-1.10.2.min.js'></script>";

    thePrompt.document.head.innerHTML = theHead;
    //Cracion de la pantalla
    var theHTML = "";
    theHTML += "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center mt-4 mb-3 mx-5'>";
    theHTML += "<p>Esta acción requiere de permisos de administrador, por favor autentifique su usuario.</p>";
    theHTML += "</div>";
    theHTML += "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'> <div class='form-group mt-2 mb-2 mx-5'>";
    theHTML += "Usuario: <input class='form-control' type='text' id='usuario' placeholder='Ingrese su usuario'/>";
    theHTML += "</div></div> <div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4'> <div class='form-group mt-2 mb-2 mx-5'>";
    theHTML += "Contraseña: <input class='form-control' type='password' id='clave' placeholder='Ingrese su contraseña'/>";
    theHTML += "</div></div><div class='d-flex justify-content-center'>";
    theHTML += "<input  class='btn btn-primary mt-3 mb-3 mx-5' style='background-color: #6AB759; border-color: #6AB759;' type='button' value='Autentificar' id='btnAutentificar'/>";
    thePrompt.document.body.innerHTML = theHTML;


    thePrompt.document.getElementById("btnAutentificar").onclick = function () {
        //Recuperacion de variables al precionar el boton
        var usuario = thePrompt.document.getElementById("usuario").value;
        var clave = thePrompt.document.getElementById("clave").value;
        $.ajax({
            type: 'POST',
            url: '../../php/facturas/consultaAdmin.php',
            data: {
                usuario: usuario,
                clave: clave
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //El usuario existe y es administrador
                    thePrompt.close();
                    //Cierre del popup y recuperacion de variables
                    document.getElementById("usuarioElimina").value = usuario;
                    document.getElementById("facturaDetalle").value = factura;
                    document.getElementById("detalleEliminar").value = producto;
                    //Cambio de la accion para eliminar el detalle
                    document.getElementById("accion").value = "eliminarDetalle";
                    document.getElementById("formulario").submit();
                } else {
                    thePrompt.close();
                    //No elimina el detalle al fallar la autentificacion
                    alert('Usuario o contraseña no válidos');
                }
            });
    }
    return false;
}

function revisarIdentidad() {
    //Al ser la primera funcion llamada para crear la factura, primero se valida que se hayan insertado productos
    if (document.querySelectorAll("button[name='btnEliminarDetalle']").length == 0) {
        alert('No puede facturar una factura sin productos');
    } else {
        //Si hay productos para esta factura, revisa que el cliente exista en la bd
        var identidad = document.getElementById("txtCliente").value;
        $.ajax({
            type: 'POST',
            url: '../../php/clientes/consultaIdentidad.php',
            data: { //Se envia la variable a consultaIdentidad.php
                identidad_cliente: identidad
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) {
                    return validar();
                } else { //Si no existe el ID, permite el registro del cliente con un popup
                    if (confirm("No existe un cliente registrado con este número de identidad, ¿Desea registrarlo?")) { //Confirmacion de desactivacion verdadera (Ok)
                        createPopupWin("../../forms/clientes/form_insertarCliente.php", "Insertar Nuevo Cliente", 800, 700);
                    } else { //Pero si no se desea registrar puede utilizarse el cliente 0 de la BD que es CONSUMIDOR FINAL
                        alert("Se utilizará el cliente CONSUMIDOR FINAL para desarrollar la factura"); 
                        document.getElementById("txtCliente").value = 0;
                        return validar();
                    }
                }
            });
    }
    return false
}

//Funcion para la creacion de un popup parametrizable
function createPopupWin(pageURL, pageTitle,
    popupWinWidth, popupWinHeight) {
    var left = (screen.width - popupWinWidth) / 2;
    var top = (screen.height - popupWinHeight) / 4;

    var myWindow = window.open(pageURL, pageTitle,
        'resizable=yes, width=' + popupWinWidth
        + ', height=' + popupWinHeight + ', top='
        + top + ', left=' + left);
    return false;
}


function validarPrefactura() {
    //Hace la revision de que se hayan insertado productos para prefacturarlos
    if (document.querySelectorAll("button[name='btnEliminarDetalle']").length == 0) {
        alert('No puede prefacturar una factura sin productos');
    } else {
        document.getElementById("accion").value = "prefacturar";
        document.getElementById("formulario").submit();
    }
    return false;
}


function validar() {
    //Ultima validacion para insertar la factura
    if (document.getElementById("txtNoFactura").value == "") {
        alert("Número de factura inválido");
        document.getElementById("txtNoFactura").focus();
    } else if (document.getElementById("cmbMetodoPago").value == "") {
        alert("Por favor seleccione un método de pago");
        document.getElementById("cmbMetodoPago").focus();
    } else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}


function facturar() {
    //Funcion llamada desde el form_actualizarFactura.php para volver a generar el PDF de una factura antigua
    if (document.getElementById("txtNoFactura").value == "") {
        alert("Número de factura inválido");
        document.getElementById("txtNoFactura").focus();
    } else {
        document.getElementById("accion").value = "facturar"; //Al actualizar este valor y hacer el submit
        document.getElementById("formulario").submit();
    }
    return false;
}

function anular() {  //Funcion llamada por el boton de Anular en form_actualizarFactura.php 
    if (confirm("¿Desea anular esta factura? (Su usuario será registrado para efectos de auditoría)")) { //Confirmacion de anulacion verdadera (Ok)
        document.getElementById("accion").value = "anular"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de anulacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}