$(document).ready(function () { //Funcion que se ejecuta al cargar la pagina
    var i = 1; //Iterador
    var data = ""; //Variable que contendra los correos separados por una coma antes de llenar el campo arrayCorreos con esta variable

    $('#btn_anadirCorreo').click(function () { //Al precionar el boton de agregar un nuevo campo de correos...
        if (document.getElementById("txtEmail" + i) != null) { //Verifica que el campo de correos anterior no este vacio y exista
            if (document.getElementById("txtEmail" + i).value != "") {
                i++; //El iterador pasa al numero 2 porque el campo txtEmail1 ya existe y tiene un valor
                $('#correos').append("<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divCorreo" + i + "'>" +
                    "<div class='form-group mt-2 mb-2'>" +
                    "<label for='txtEmail' class='form-label'>Correo Electrónico</label>" +
                    "<input type='email' style='float: left;' class='form-control' name='txtEmail" + i + "' id='txtEmail" + i + "' maxlength='45' placeholder='Ingrese el nuevo correo' value=''>" +
                    "<button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_removeCorreo mx-3 mb-1'>-</button>" +
                    "</div>" +
                    "</div>");
                //Toma el div con id=correos y le añade la cadena en HTML donde se crea un nuevo div con el campo de correo nuevo
            } else { // Si txtCorreo1 está vacio no añade un nuevo div de correo
                alert("Por favor rellene el campo de correo actual");
            }
        } else { //Si el campo de correo anterior es nulo o sea que no existe crea uno nuevo sin comprobar si ese campo anterior esta vacio
            i++;
            $('#correos').append("<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4' id='divCorreo" + i + "'>" +
                "<div class='form-group mt-2 mb-2'>" +
                "<label for='txtEmail' class='form-label'>Correo Electrónico</label>" +
                "<input type='email' style='float: left;' class='form-control' name='txtEmail" + i + "' id='txtEmail" + i + "' maxlength='45' placeholder='Ingrese el nuevo correo' value=''>" +
                "<button type='button' name='remove' id='" + i + "' class='btn btn-danger btn_removeCorreo mx-3 mb-1'>-</button>" +
                "</div>" +
                "</div>");
            //Y retorna el div con el campo y el boton de eliminado
        }
        return false;
    });

    $(document).on('click', '.btn_removeCorreo', function () { //Al presionar el boton de eliminar...
        var id = $(this).attr('id'); //Recupera el id de este boton que fue presionado
        $('#divCorreo' + id).remove(); //Y como eseel numero en ese id corresponde al numero en el id de divCorreo_ recoge ese div por su id y lo elimina
        return false;
    });

    $('#btnGuardar').click(function () { //Al presionar el boton de guardar...
        data = $('#correos').find('input').serialize(); //Recoge todos los inputs en el div de correo, incluyendo el id del input y su value
        for (let j = (i + 20); j >= 1; j--) {
            data = data.replace("txtEmail" + j + "=", ""); //Como no nos interesa el id del input reemplazamos esas partes recuperadas por un vacio
            data = data.replace("%40", "@"); //Y el serialize de JQuey no esta configurado para aceptar caracteres como @ asi que reemplazamos el valor %40 que añade en lugar del @ por el @
        }
        data = data.replace("&", ","); //Cuando son varios inputs los devuelve como una sola cadena separados por & pero nos interesa separarlos por una coma asi que se reemplaza ese valor

        if (data.charAt(data.length - 1) == ",") { //Por ultimo, si el ultimo caracter de la cadena es una coma (caso en el que se haya creado un nuevo divCorreo sin haberlo llenado)
            data = data.substring(0, data.length - 1) //Se borra esa ultima coma de la cadena
        }
        document.getElementById("arrayCorreos").value = data; //Y se asigna el valor de la variable data al input escondido arrayCorreos del form

        if (document.getElementById('accion').value != 'guardar') {
            if (document.getElementById('accion').value != 'faltante') {
                return validar(); //Y devuelve la funcion de validacion de el script correspondiente (clientes.js por ejemplo)
            }
        }
    });
    return false;
})