function revisarIdDescuento() {
    //Revisa mediante AJAX que no se trate de insertar un numero del idDescuento vacio o uno ya registrado
    var idDescuento = document.getElementById("txtIdDescuento").value;
    if (idDescuento == "") {
        alert("Por favor ingrese la ID del Descuento");
        document.getElementById("txtIdDescuento").focus();
    } else if (idDescuento.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/descuentos/consultaId.php',
            data: { //Se envia la variable a consultaId.php
                id_descuento: idDescuento
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaIdentidad.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un descuento con este número de ID");
                } else { //Si no existe el ID, pasa a la siguiente funcion de abajo
                    return validar();
                }
            });
    }
    return false
}

function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    if (document.getElementById("txtNombre").value == "") {
        alert("Por favor ingrese el nombre del descuento");
        document.getElementById("txtNombre").focus();
    } else if (document.getElementById("txtValor").value == "") {
        alert("Por favor ingrese una valor del descuento");
        document.getElementById("txtValor").focus();
    }else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarDescuento.php 
    if(confirm("¿Desea desactivar a este descuento del sistema?")){ //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}