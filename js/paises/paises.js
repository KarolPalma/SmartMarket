function cargarDepartamentos() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaDepto.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaDepto.php",
        dataType: 'html',
        data: {
            'pais': $('#cmbPais').val(), //Recupera el valor en cmbPais
            'departamento': $('#departamento').val() //Recupera el valor en departamento (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) { //Responde con el llenado del cmbDepto con la cadena de respuesta de PHP
            $('#cmbDepto').html(respuesta);
        }
    });
    return false;
}

function cargarCiudades() { //Solicita una consulta de PHP a la BD mediante datos mandados como JSON a consultaCiudad.php
    $.ajax({
        type: "POST",
        url: "../../php/paises/consultaCiudad.php",
        dataType: 'html',
        data: {
            'depto': $('#cmbDepto').val(), //Recupera el valor en cmbDepto
            'ciudad': $('#ciudad').val() //Recupera el valor en ciudad (solo usado en actualizaciones de registros) para marcar un option como seleccionado
        },
        success: function (respuesta) {
            $('#cmbCiudad').html(respuesta); //Responde con el llenado del cmbCiudad con la cadena de respuesta de PHP
        }
    });
    return false;
}

$(document).ready(function () { //Al cargar la pagina se activa esta funcion
    cargarDepartamentos();

    $('#cmbPais').change(function () { //Al cambiar el estado del cmbPais se recargan los departamentos
        cargarDepartamentos();
    });
    return false;
})

$(document).ready(setTimeout(function () { //Despues de 0.0100 segundos de cargar la pagina se llama a esta funcion
    cargarCiudades();

    $('#cmbDepto').change(function () { //Al cambiar el estado del cmbDepto se recargan las ciudades
        cargarCiudades();
    });
    return false;
}, 100)); //Este retraso es porque para marcar una ciudad como seleccionada, el departamento debe estar seleccionado tambien
          //Asi que despues de 0.100 segundos tanto el departamento como la ciudad pueden seleccionarse correctamente