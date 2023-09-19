<?php
include("../menu/menu.php");
//Incluye el menu de la aplicacion.
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/bitacora/recuperarBitacora.php");
//Incluye el archivo php que recupera los datos de la BD mediante una vista para utilizar esos valores en los campos.
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../../recursos/bus.ico" rel="shortcut icon" type="image/x-icon">
        <title>Vista Bitacora - Smart Market</title>
    </head>

    <body>
        <!--Tanto los valores de Bootstrap como los de las variables escondidas se explican en el form_insertarCliente.php-->
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Vista Bitacora</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Recupera la variable de session en este input escondido para su utilizacion en el insertado de informacion-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <!--Id. Registro-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtidRegistro" class="form-label">Id. del Registro</label>
                                <input type="text" class="form-control" name="txtidRegistro" id="txtidRegistro" <?php echo 'value="' . $_GET['idRegistro'] . '"' ?> readonly>
                                <!--Un campo de solo lectura que tiene como valor la identidad traida del metodo GET-->
                            </div>
                        </div>
                        <!--Id. Usuario-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtidUsuario" class="form-label">Id. del Usuario</label>
                                <input type="text" class="form-control" name="txtidUsuario" id="txtidUsuario" <?php echo "value='$idUsuario'" ?> readonly>
                                <!--Campo que utiliza la variable de id_usuario de recuperarBitacora.php-->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <!--Fecha-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="dtefechaRegistro" class="form-label">Fecha del Registro</label>
                                <input type="date" class="form-control" name="dtefechaRegistro" id="dtefechaRegistro" <?php echo "value='$fecha'" ?> readonly>
                                <!--Campo que utiliza la variable de fecha de recuperarBitacora.php-->
                            </div>

                        </div>
                        <!--Hora-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtHora" class="form-label">Hora del Registro</label>
                                <input type="text" class="form-control" name="txtHora" id="txtHora" <?php echo "value='$hora'" ?> readonly>
                                <!--Campo que utiliza la variable de hora de recuperarBitacora.php-->
                            </div>
                        </div>
                        <!--Detalles-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtDetalle" class="form-label">Detalles</label>
                                <textarea rows="4" cols="50" class="form-control" name="txtDetalle" id="txtDetalle" readonly><?php echo "" . $detalle ?></textarea>
                                <!--Campo que utiliza la variable de detalle de recuperarBitacora.php-->
                            </div>
                        </div>
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;" href='form_filtroBitacora.php'> Regresar</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <footer style="position: absolute; bottom: 0;">
            <!--Footer de la aplicacion-->
            <div style="background-color: #24242c; width: 1496px; height: 58px;"></div>
        </footer>
    </body>

    </html>
<?php
} else { //Pagina que se carga cuando se trata de acceder con la url sin ser administrador
    echo "<script>
            window.location.href = '../../forms/principal/principal.php';
        </script>";
}
?>