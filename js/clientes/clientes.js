function revisarIdentidad() {
    //Revisa mediante AJAX que no se trate de insertar un numero de identidad vacio o uno ya registrado
    var identidad = document.getElementById("txtIdentidad").value;
    if (identidad == "") {
        alert("Por favor ingrese la identidad del cliente");
        document.getElementById("txtIdentidad").focus();
        document.getElementById("accion").value = "faltante";
    } else if (identidad.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/clientes/consultaIdentidad.php',
            data: { //Se envia la variable a consultaIdentidad.php
                identidad_cliente: identidad
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaIdentidad.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un cliente con este número de identidad");
                    document.getElementById("accion").value = "faltante";
                } else { //Si no existe el ID, pasa a la siguiente funcion de abajo
                    return validar();
                }
            });
    }
    return false
}

function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    //Para el form_actualizarCliente.php esta funcion es llamada desde correosDinamicos.js
    if (document.getElementById("txtNombres").value == "") {
        alert("Por favor ingrese el nombre del cliente");
        document.getElementById("txtNombres").focus();
    } else if (document.getElementById("txtApellidos").value == "") {
        alert("Por favor ingrese el apellido del cliente");
        document.getElementById("txtApellidos").focus();
    } else if (document.getElementById("dtefnac").value == "") {
        alert("Por favor seleccione una fecha de nacimiento");
        document.getElementById("dtefnac").focus();
    } else if (document.getElementById("cmbGenero").value == "") {
        alert("Por favor seleccione un género");
        document.getElementById("cmbGenero").focus();
    } else if (document.getElementById("cmbPais").value == "") {
        alert("Por favor seleccione un país de origen");
        document.getElementById("cmbPais").focus();
    } else if (document.getElementById("cmbDepto").value == "") {
        alert("Por favor seleccione un departamento de origen");
        document.getElementById("cmbDepartamento").focus();
    } else if (document.getElementById("cmbCiudad").value == "") {
        alert("Por favor seleccione una ciudad de origen");
        document.getElementById("cmbCiudad").focus();
    } else if (document.getElementById("txtDireccion").value == "") {
        alert("Favor ingrese la dirección del empleado");
        document.getElementById("txtDireccion").focus();
    } else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarCliente.php 
    if (confirm("¿Desea desactivar a este cliente del sistema?")) { //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}