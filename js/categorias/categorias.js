function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    if (document.getElementById("txtCategoria").value == "") {
        alert("Por favor ingrese un nombre para la categoría");
        document.getElementById("txtCategoria").focus();
    } else if (document.getElementById("txtDescripcion").value == "") {
        alert("Por favor ingrese la descripción de la categoría");
        document.getElementById("txtDescripcion").focus();
    } else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() { 
    if(confirm("¿Desea desactivar esta categoría del sistema?")){ //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}