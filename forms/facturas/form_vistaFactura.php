<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/facturas/recuperarFacturaVista.php");
include("../../php/facturas/actualizarFactura.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../../recursos/sm.ico" rel="shortcut icon" type="image/x-icon">
        <title>Vista Factura - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/facturas/facturas.js"></script>
        <!--Script de validación de campos-->
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #6AB759; color: white;">Visualización de Factura</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Accion que será cambiada por la funcion validar en clientes.js-->
                <!--Modificar usuario a POST cuando se tenga la variable de sesion de usuario (luego del login)-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--No. Factura-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <label for="txtNoFactura" class="form-label">No. de Factura</label>
                                <input type="text" class="form-control" name="txtNoFactura" id="txtNoFactura" <?php echo 'value="' . $_GET['idFactura'] . '"' ?> readonly>
                            </div>
                        </div>
                        <!--Fecha-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtFecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" name="txtFecha" id="txtFecha" value="<?php echo $fecha ?>" readonly />
                            </div>
                        </div>
                        <!--Hora-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtHora" class="form-label">Hora</label>
                                <input type="time" class="form-control" name="txtHora" id="txtHora" value="<?php echo $hora ?>" readonly>
                            </div>
                        </div>
                        <!--Detalle-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label class="form-label" style="font-weight: bold;">Detalle de Productos</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="d-flex justify-content-center my-4">
                            <table id='tabla' class="table table-striped table-bordered" style="max-width: 1100px;">
                                <thead>
                                    <tr>
                                        <th scope='col' style='text-align: center;'>Código</th>
                                        <th scope='col' style='text-align: center;'>Producto</th>
                                        <th scope='col' style='text-align: center;'>Cantidad Unidades</th>
                                        <th scope='col' style='text-align: center;'>Precio Unitario</th>
                                        <th scope='col' style='text-align: center;'>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--Inclusion de productos ya añadidos en la tabla-->
                                    <?php
                                    $factura = isset($_GET['idFactura']) ? $_GET["idFactura"] : "";
                                    $sql = "SELECT * FROM v_Detalles_Facturados
                                        WHERE Id_Factura = '" . $factura . "';";
                                    $result = mysqli_query($conexion, $sql); //Si la respuesta contiene por lo menos un registro, imprime la tabla
                                    while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                                        echo
                                        "<tr>
                                        <th scope='row' style='text-align: center;'>" . $row["Id_Producto"] . "</th>
                                        <td scope='row' style='text-align: center;'>" . $row["Nombre_Producto"] . "</td>
                                        <td scope='row' style='text-align: center;'>" . $row["Cantidad_Unidades"] . "</td>
                                        <td scope='row' style='text-align: center;'>L. " . round($row["Precio"], 2) . "</td>
                                        <td scope='row' style='text-align: center;'>L. " . round($row["Monto"], 2) . "</td>
                                        </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <!--SubTotal-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtSubtotal" class="form-label">SubTotal</label>
                                <div class="form-inline">
                                    <p style="float: left; margin-top: 6px;">L.</p>
                                    <p style="float: left; width: 20px;"></p>
                                    <input type="number" class="form-control" style="max-width: 380px; float: left;" name="txtSubtotal" id="txtSubtotal" step="0.01" readonly <?php echo "value='" . $subtotal . "'" ?>>
                                </div>
                            </div>
                        </div>
                        <!--Total-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtTotal" class="form-label">Total</label>
                                <div class="form-inline">
                                    <p style="float: left; margin-top: 6px;">L.</p>
                                    <p style="float: left; width: 20px;"></p>
                                    <input type="number" class="form-control" style="max-width: 380px; float: left;" name="txtTotal" id="txtTotal" step="0.01" readonly <?php echo "value='" . $total . "'" ?>>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                            <!--Cliente-->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group mt-2 mb-2">
                                    <label for="txtCliente" class="form-label">No. Identidad del Cliente</label>
                                    <input type="text" class="form-control" name="txtCliente" id="txtCliente" placeholder="Ingrese el número de identidad del cliente" <?php echo "value='" . $idCliente . "'" ?> readonly>
                                </div>
                            </div>
                            <!--Metodo de Pago-->
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group mt-2 mb-2">
                                    <label for="cmbMetodoPago" class="form-label">Método de Pago</label>
                                    <select class="form-control" name="cmbMetodoPago" id="cmbMetodoPago" disabled>
                                        <option value="">-- Seleccione un Método de Pago --</option>
                                        <!--Rellenado mediante BD-->
                                        <!-------------------------------------------------------------------------------------------------------------------------------------->
                                        <?php
                                        $sql = "SELECT Id_Metodo_Pago, Metodo_Pago FROM Metodos_Pago";
                                        $result = mysqli_query($conexion, $sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            if ($row['Id_Metodo_Pago'] == $metodoPago) {
                                                echo "<option selected value='" . $row["Id_Metodo_Pago"] . "'>" . $row['Metodo_Pago'] . "</option>";
                                            } else {
                                                echo "<option value='" . $row["Id_Metodo_Pago"] . "'>" . $row['Metodo_Pago'] . "</option>";
                                            }
                                        }
                                        ?>
                                        <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    </select>
                                </div>
                            </div>

                            <?php
                            if ($estadoFactura == 1) {
                            ?>

                                <!--Fecha Anulada-->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group mt-2 mb-2">
                                        <label for="txtFechaAnulacion" class="form-label">Fecha Anulación</label>
                                        <input type="date" class="form-control" name="txtFechaAnulacion" id="txtFechaAnulacion" value="<?php echo $fechaAnulacion ?>" readonly />
                                    </div>
                                </div>
                                <!--Hora Anulacion-->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group mt-2 mb-2">
                                        <label for="txtHoraAnulacion" class="form-label">Hora Anulación</label>
                                        <input type="time" class="form-control" name="txtHoraAnulacion" id="txtHoraAnulacion" value="<?php echo $horaAnulacion ?>" readonly>
                                    </div>
                                </div>
                                <!--Empleado que Anulo-->
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                    <div class="form-group mt-2 mb-2">
                                        <label for="cmbEmpleado" class="form-label">Empleado que Anulo la Factura</label>
                                        <select class="form-control" name="cmbEmpleado" id="cmbEmpleado" disabled>
                                            <!--Rellenado mediante BD-->
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                            <?php
                                            $sql = "SELECT U.Id_Usuario, CONCAT(E.Nombres, ' ', E.Apellidos) AS Nombre
                                            FROM Usuarios AS U INNER JOIN Empleados AS E ON U.Id_Empleado = E.Id_Empleado
                                            WHERE U.Id_Usuario = '$anulador'
                                            ORDER BY U.Id_Usuario";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option selected value='" . $row["Id_Usuario"] . "'>" . $row['Nombre'] . "</option>";
                                            }
                                            ?>
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                        </select>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="row">
                                <!--Botones-->
                                <div class="d-flex justify-content-center">
                                    <?php
                                    if ($estadoFactura == 0) {
                                        echo "<button onClick='return anular()' name='btnAnular' id='btnAnular' class='btn btn-secondary m-5' style='background-color: #F08946; border-color: #F08946;'>Anular Factura</button>";
                                    ?>
                                        <button onClick="return facturar()" name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Generar PDF</button>
                                        <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
                                    <?php
                                    } else {
                                        echo "<a class='btn btn-secondary m-3' href='form_filtroFactura.php'> Regresar</a>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <footer style="clear: both; position: relative; margin-top: 100px;">
            <div style="background-color: #24242c; width: 1481px; height: 58px;"></div>
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