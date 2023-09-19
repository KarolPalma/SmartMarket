function revisarIdImpuesto() {
    //Revisa mediante AJAX que no se trate de insertar un numero del idImpuesto vacio o uno ya registrado
    var idImpuesto = document.getElementById("txtIdImpuesto").value;
    if (idImpuesto == "") {
        alert("Por favor ingrese la ID del Impuesto");
        document.getElementById("txtIdImpuesto").focus();
    } else if (idImpuesto.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/impuestos/consultaId.php',
            data: { //Se envia la variable a consultaId.php
                id_impuesto: idImpuesto
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaIdentidad.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un impuesto con este número de ID");
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
        alert("Por favor ingrese el nombre del impuesto");
        document.getElementById("txtNombre").focus();
    } else if (document.getElementById("txtValor").value == "") {
        alert("Por favor ingrese una valor del impuesto");
        document.getElementById("txtValor").focus();
    }else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarImpuesto.php 
    if(confirm("¿Desea desactivar a este impuesto del sistema?")){ //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}