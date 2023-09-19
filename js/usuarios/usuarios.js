function revisarUsuario() {
    //Revisa mediante AJAX que no se trate de insertar un usuario vacio o uno ya registrado
    var usuario = document.getElementById("txtUsuario").value;
    if (usuario == "") {
        alert("Por favor ingrese el id del usuario");
        document.getElementById("txtUsuario").focus();
    } else if (usuario.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/usuarios/consultaUsuario.php',
            data: { //Se envia la variable a consultaUsuario.php
                usuario: usuario
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaUsuario.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un usuario con este número");
                } else { //Si no existe el ID, pasa a la siguiente funcion de abajo
                    return validar();
                }
            });
    }
    return false
}

function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    if (document.getElementById("cmbEmpleado").value == "") {
        alert("Por favor seleccione un empleado");
        document.getElementById("cmbEmpleado").focus();
    } else if (document.getElementById("txtClave").value == "") {
        alert("Por favor ingrese una clave");
        document.getElementById("txtClave").focus();
    } else if (document.getElementById("cmbTipo").value == "") {
        alert("Por favor seleccione un tipo de usuario");
        document.getElementById("cmbTipo").focus();
    } else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarUsuario.php 
    if (confirm("¿Desea desactivar a este usuario del sistema?")) { //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}