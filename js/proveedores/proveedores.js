function validar() {
    //Valida que los campos requeridos no se encuentren vacios
    //Para el form_actualizarProveedores.php esta funcion es llamada desde correosDinamicos.js
    if (document.getElementById("txtNombreProveedor").value == "") {
        alert("Por favor ingrese el nombre del proveedor");
        document.getElementById("txtNombreProveedor").focus();
    } else if (document.getElementById("txtContacto").value == "") {
        alert("Por favor ingrese el nombre del contacto referenciado para este proveedor");
        document.getElementById("txtContacto").focus();
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

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarProveedores.php 
    if (confirm("¿Desea desactivar a este proveedor del sistema?")) { //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}