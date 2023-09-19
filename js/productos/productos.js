function revisarIdProducto() {
    //Revisa mediante AJAX que no se trate de insertar un numero del idProducto vacio o uno ya registrado
    var idProducto = document.getElementById("txtIdProducto").value;
    if (idProducto == "") {
        alert("Por favor ingrese la ID del Producto");
        document.getElementById("txtIdProducto").focus();
    } else if (idProducto.value != "") {
        $.ajax({
            type: 'POST',
            url: '../../php/productos/consultaId.php',
            data: { //Se envia la variable a consultaId.php
                id_producto: idProducto
            },
            dataType: 'html'
        })
            .done(function (respuesta) {
                if (respuesta == 1) { //Si el conteo de registros de cosultaId.php es igual a 1, quiere decir que ya existe ese ID
                    alert("Ya existe un producto con este número de ID");
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
        alert("Por favor ingrese el nombre del producto");
        document.getElementById("txtNombre").focus();
    } else if (document.getElementById("txtDescripcion").value == "") {
        alert("Por favor ingrese una descripción del producto");
        document.getElementById("txtDescripcion").focus();
    } else if (document.getElementById("cmbCategoria").value == "") {
        alert("Por favor seleccione una categoría");
        document.getElementById("cmbCategoria").focus();
    } else if (document.getElementById("cmbProveedor").value == "") {
        alert("Por favor seleccione un proveedor");
        document.getElementById("cmbProveedor").focus();
    } else if (document.getElementById("txtCantidad").value == "") {
        alert("Por favor ingrese una cantidad por unidad");
        document.getElementById("txtCantidad").focus();
    } else if (document.getElementById("txtUnidad").value == "") {
        alert("Por favor ingrese una unidad de almacen");
        document.getElementById("txtUnidad").focus();
    } else if (document.getElementById("txtCantidadMax").value == "") {
        alert("Por Favor ingrese una cantidad máxima");
        document.getElementById("txtCantidadMax").focus();
    } else if (document.getElementById("txtCantidadMin").value == "") {
        alert("Por favor ingrese una cantidad mínima");
        document.getElementById("txtCantidadMin").focus();
    } else if (document.getElementById("txtPrecios").value == "") {
        alert("Por Favor ingrese un precio");
        document.getElementById("txtPrecios").focus();
    }else {
        document.getElementById("accion").value = "guardar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de guardado en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function desactivar() {  //Funcion llamada por el boton de Desactivar en form_actualizarProducto.php 
    if(confirm("¿Desea desactivar este producto del sistema?")){ //Confirmacion de desactivacion verdadera (Ok)
        document.getElementById("accion").value = "desactivar"; //Al actualizar este valor y hacer el submit puede realizarse la operacion de desactivacion en BD
        document.getElementById("formulario").submit();
    }
    return false;
}

function generar() {
    document.getElementById("accion").value = "generar"; //Al cambiar este valor, el incrutado PHP entra a la condicion de generar el PDF de pedido del producto
    document.getElementById("formulario").submit();
    return false;
}