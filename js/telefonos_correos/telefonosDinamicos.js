$(document).ready(function () { //Tiene el mismo funcionamiento descrito en correosDinamicos solo que reeamplazando correos por telefonos
    var i = 1;
    var data = "";

    $('#btn_anadirTelefono').click(function () {
        if (document.getElementById("txtTelefono" + i) != null) {
            if (document.getElementById("txtTelefono" + i).value != "") {
                i++;
                $('#telefonos').append("<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divTelefono" + i + "'>" +
                    "<div class='form-group mt-2 mb-2'>" +
                    "<label for='txtTelefono' class='form-label'>Número Teléfonico</label>" +
                    "<input type='text' style='float: left;' class='form-control' name='txtTelefono" + i + "' id='txtTelefono" + i + "' maxlength='10' placeholder='Ingrese el nuevo teléfono' value=''>" +
                    "<button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_removeTelefono mx-3 mb-1'>-</button>" +
                    "</div>" +
                    "</div>");
            } else {
                alert("Por favor rellene el campo de teléfono actual");
            }
        } else {
            i++;
            $('#telefonos').append("<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divTelefono" + i + "'>" +
                "<div class='form-group mt-2 mb-2'>" +
                "<label for='txtTelefono' class='form-label'>Número Teléfonico</label>" +
                "<input type='text' style='float: left;' class='form-control' name='txtTelefono" + i + "' id='txtTelefono" + i + "' maxlength='10' placeholder='Ingrese el nuevo teléfono' value=''>" +
                "<button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_removeTelefono mx-3 mb-1'>-</button>" +
                "</div>" +
                "</div>");
        }
        return false;
    });

    $(document).on('click', '.btn_removeTelefono', function () {
        var id = $(this).attr('id');
        $('#divTelefono' + id).remove();
        return false;
    });

    $('#btnGuardar').click(function () {
        data = $('#telefonos').find('input').serialize();
        for (let j = (i + 20); j >= 1; j--) {
            data = data.replace("txtTelefono" + j + "=", "");
            data = data.replace("&", ",");
        }
        
        if (data.charAt(data.length - 1) == ",") {
            data = data.substring(0, data.length - 1)
        }
        document.getElementById("arrayTelefonos").value = data;

        return false; //Esta no debe retornar la funcion de validar, ya que se ejecuta antes de correosDinamicos (los scripts deben ser llamados en orden)
    });
    return false;
})