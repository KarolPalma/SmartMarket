function corroborarUsuario() {
    //Funcion que revisa que el usuario y la clave proprocionados concuerden con un registro en la bd.
    var clave = document.getElementById("txtPass").value;
    var usuario = document.getElementById("txtUsuario").value;
    if (clave == "" || usuario == "") {
        alert("Por favor rellene todos los campos");
    } else if (clave != "" && usuario != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/principal/consultaClave.php',
            data: {
                empleado_usuario: usuario,
                empleado_clave: clave
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si existen y esta activo pasa a la siguiente funcion
                    return consultarIngreso();
                } else {
                    alert("El usuario o clave ingresados no son válidos");
                }
            });
    }
    return false
}

function consultarIngreso() { //Revisa que no se haya vaciado el usuario, pues debe usarse para la variable de sesion
    var usuario = document.getElementById("txtUsuario").value;
    if (usuario == "") {
        alert("Por favor rellene todos los campos");
    } else if (usuario != "") {
        document.getElementById("respuesta").value = 1
        return document.getElementById("formulario").submit();

    }
    return false;
}