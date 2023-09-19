function revisarIdentidad() {
    //Revisa mediante AJAX que no se trate de insertar un numero de identidad vacio o uno ya registrado
    var identidad = document.getElementById("txtIdentidad").value;
    if (identidad == "") {
        alert("Por favor ingrese la identidad del empleado");
        document.getElementById("txtIdentidad").focus();
        document.getElementById("accion").value = "faltante";
    } else if (identidad.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/empleados/consultaIdentidad.php',
            data: { //Se envia la variable a consultaIdentidad.php
                identidad_empleado: identidad
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaIdentidad.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un empleado con este número de identidad");
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
    //Para el form_actualizarEmpleado.php esta funcion es llamada desde correosDinamicos.js

    //fecha creada para usarla como fecha de contratacion
    if (document.getElementById("txtNombres").value == "") {
        alert("Por favor ingrese el nombre del empleado");
        document.getElementById("txtNombres").focus();
    } else if (document.getElementById("txtApellidos").value == "") {
        alert("Por favor ingrese el apellido del empleado");
        document.getElementById("txtApellidos").focus();
    } else if (document.getElementById("dtefnac").value == "") {
        alert("Por favor seleccione una fecha de nacimiento");
        document.getElementById("dtefnac").focus();
    } else if (document.getElementById("dtefccont").value == "") {
        alert("Por favor seleccione una fecha de inicio de contrato");
        document.getElementById("dtefccont").focus();
    } else if (document.getElementById("dteffcont").value == "") {
        alert("Por favor seleccione una fecha de finalización de contrato");
        document.getElementById("dteffcont").focus();
    } else if (document.getElementById("dteffcont").value <= document.getElementById("dtefccont").value) {
        alert("La fecha de finalización de la contratación debe ser mayor a la fecha del inicio de la contratación");
        document.getElementById("dteffcont").focus();
    } else if (document.getElementById("cmbGenero").value == "") {
        alert("Por favor seleccione un género");
        document.getElementById("cmbGenero").focus();
    } else if (document.getElementById("txtCargo").value == "") {
        alert("Por favor seleccione un cargo");
        document.getElementById("txtCargo").focus();
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

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarEmpleado.php 
    if (confirm("¿Desea desactivar a este empleado del sistema?")) { //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}