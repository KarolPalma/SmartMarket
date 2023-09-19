<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/descuentos/insertarDescuento.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Insertar Descuento - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/descuentos/descuentos.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #6AB759; color: white;">Insertar Descuento</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Accion que será cambiada por la funcion validar en descuentos.js-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Bootstrap: Divide en filas la pagina-->
                        <!--Id. Descuento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <?php $sql = "SELECT (COUNT(*) + 1) AS C FROM Descuentos";
                                $noDescuento = 0;
                                $result = mysqli_query($conexion, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $noDescuento = $row["C"];
                                } ?>
                                <label for="txtIdDescuento" class="form-label">No. Descuento</label>
                                <input type="number" class="form-control" name="txtIdDescuento" id="txtIdDescuento" maxlength="15" <?php echo "value='$noDescuento'"; ?> readonly>
                            </div>
                        </div>
                        <!--Nombre Descuento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombre" class="form-label">Nombre del Descuento</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" maxlength="45" placeholder="Ingrese nombre del descuento" value="">
                            </div>
                        </div>
                        <!--Valor Descuento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtValor" class="form-label">Valor</label>
                                <input style="float: left;" type="number" class="form-control" name="txtValor" id="txtValor" maxlength="10" placeholder="Ingrese el valor del descuento" value="">
                            </div>
                        </div>
                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <button name="btnLimpiar" id="btnLimpiar" class="btn btn-secondary m-5">Limpiar</button>
                                <button onClick="return revisarIdDescuento()" name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Guardar</button>
                                <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <footer style="position: absolute; bottom: 0;">
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