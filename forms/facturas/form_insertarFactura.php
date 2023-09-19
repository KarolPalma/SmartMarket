<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/facturas/insertarFactura.php");
include("../../php/facturas/eliminarDetalle.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="../../recursos/sm.ico" rel="shortcut icon" type="image/x-icon">
    <title>Facturar - Smart Market</title>
    <script src="../../js/jquery-1.10.2.min.js"></script>
    <!--Libreria básica de JQuery-->
    <script src="../../js/facturas/facturas.js"></script>
    <!--Script de validación de campos-->
</head>

<body>
    <div class="container">
        <div class="col-12 text-center mt-5 mb-5">
            <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
            <h3 style="background-color: #6AB759; color: white;">Facturación</h3>
        </div>
        <form name='formulario' id='formulario' method='POST' action="">
            <input type="hidden" name="accion" id="accion" value="">
            <!--Accion que será cambiada por la funcion validar en clientes.js-->
            <input type="hidden" name="apertura" id="apertura" <?php echo "value='" . $_POST["apertura"] . "'" ?>>
            <!--Será llenado al dar click por primera vez al agregado de un producto-->
            <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
            <div class="col-12">
                <div class="row">
                    <!--Bootstrap: Divide en filas la pagina-->
                    <?php $sql = "SELECT (COUNT(*) + 1) AS C FROM Facturas";
                    $noFactura = 0;
                    $result = mysqli_query($conexion, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $noFactura = $row["C"];
                    } //Recupera la siguiente factura para ser ingresada en la BD
                    ?>
                    <!--No. Factura-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                        <div class="form-group mt-2 mb-2">
                            <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                            <label for="txtNoFactura" class="form-label">No. de Factura</label>
                            <input type="text" class="form-control" name="txtNoFactura" id="txtNoFactura" <?php
                                                                                                            if ($_POST['txtNoFactura'] == '') {
                                                                                                                echo "value='$noFactura'";
                                                                                                            } else {
                                                                                                                echo "value='" . $_POST['txtNoFactura'] . "'";
                                                                                                            }

                                                                                                            ?> readonly>
                        </div>
                    </div>
                    <!--Fecha-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group mt-2 mb-2">
                            <label for="txtFecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="txtFecha" id="txtFecha" value="<?php echo date('Y-m-d'); ?>" readonly />
                            <!--Imprime la fecha actual-->
                        </div>
                    </div>
                    <!--Hora-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group mt-2 mb-2">
                            <label for="txtHora" class="form-label">Hora</label>
                            <input type="time" class="form-control" name="txtHora" id="txtHora" value="<?php echo date('H:i:s', time() - 3600); ?>" readonly>
                            <!--Imprimer la hora actual-->
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
                    <input type="hidden" name="usuarioElimina" id="usuarioElimina" value="">
                    <input type="hidden" name="facturaDetalle" id="facturaDetalle" value="">
                    <input type="hidden" name="detalleEliminar" id="detalleEliminar" value="">
                    <!--Variables que son llenadas al momento de eliminar un producto, se llenan mediante el login del administrador
                        para registrar la eliminacion de este detalle en la bitacora.-->

                    <div class="d-flex justify-content-center my-4">
                        <table id='tabla' class="table table-striped table-bordered" style="max-width: 1100px;">
                            <thead>
                                <tr>
                                    <!--Encabezado de tabla-->
                                    <th scope='col' style='text-align: center;'>Producto</th>
                                    <th scope='col' style='text-align: center;'>Cantidad Unidades</th>
                                    <th scope='col' style='text-align: center;'>Descuento</th>
                                    <th scope='col' style='text-align: center;'>Impuesto</th>
                                    <th scope='col' style='text-align: center;'>Total</th>
                                    <th scope='col' style='text-align: center;'>Acción</th>
                                </tr>
                            </thead>
                            <tbody>


                                <?php
                                include("../../php/facturas/insertarDetalle.php");
                                ?>
                                <!--Se incluye este php aqui para permitir el cambio de valor de la variable oculta de accion
                                    y a la vez que se inserte el detalle antes de la nueva impresion de detalles a continuacion-->

                                <!--Inclusion de productos ya añadidos en la tabla-->
                                <?php
                                $factura = isset($_POST['txtNoFactura']) ? $_POST["txtNoFactura"] : "";
                                $sql = "SELECT * FROM v_Detalles
                                        WHERE Id_Factura = '" . $factura . "';";
                                $result = mysqli_query($conexion, $sql); //Si la respuesta contiene por lo menos un registro, imprime la tabla
                                while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                                    echo
                                    "<tr>
                                        <th scope='row' style='text-align: center;'>" . $row["Nombre_Producto"] . "</th>
                                        <td scope='row' style='text-align: center;'>" . $row["Cantidad_Unidades"] . "</td>
                                        <td scope='row' style='text-align: center;'>L. " . round($row["Descuento"], 2) . "</td>
                                        <td scope='row' style='text-align: center;'>L. " . round($row["Impuesto"], 2) . "</td>
                                        <td scope='row' style='text-align: center;'>L. " . round($row["Total_Detalle"], 2) . "</td>
                                        <td scope='row' style='text-align: center;'>
                                            <button type='button' name='btnEliminarDetalle' id='btnEliminarDetalle' class='btn btn-primary mx-3 mb-1' style='background-color: #535353; border-color: #535353;'
                                            onclick='return eliminarDetalle(\"" . $row["Id_Factura"] . "\",\"" . $row["Id_Producto"] . "\")' >-</button>
                                        </td>
                                        </tr>";
                                    //La ultima columna de los botones llama a la funcion de eliminacion de detalle que crea un popup para la autentificacion del administrador
                                }
                                ?>
                                <!--Rellenado de un nuevo producto-->
                                <tr>
                                    <th scope='row' style='text-align: center;'>
                                        <select class="form-control" name="cmbProducto" id="cmbProducto">
                                            <option value="">-- Seleccione un Producto --</option>
                                            <!--Rellenado mediante BD-->
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                            <?php
                                            $sql = "SELECT Id_Producto, Nombre_Producto FROM Productos WHERE Descontinuado = 0 AND Unidades_Almacen >= 1";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Id_Producto'] . "'>" . $row['Nombre_Producto'] . "</option>";
                                            }
                                            ?>
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                        </select>
                                    </th>
                                    <td scope='row' style='text-align: center;'>
                                        <input type="number" class="form-control" name="txtCantidad" id="txtCantidad" style="max-width: 160px;">
                                    </td>
                                    <td scope='row' style='text-align: center;'>
                                        <select class="form-control" name="cmbDescuento" id="cmbDescuento">
                                            <option value="">-- Seleccione un Descuento --</option>
                                            <!--Rellenado mediante BD-->
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                            <?php
                                            $sql = "SELECT Id_Descuento, Nombre_Descuento FROM v_Descuento WHERE Id_Descuento = 4";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Id_Descuento'] . "'>" . $row['Nombre_Descuento'] . "</option>";
                                            }
                                            $sql = "SELECT Id_Descuento, Nombre_Descuento FROM v_Descuento WHERE Valor_Descuento <> 0.0000";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Id_Descuento'] . "'>" . $row['Nombre_Descuento'] . "</option>";
                                            }
                                            ?>
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                        </select>
                                    </td>
                                    <td scope='row' style='text-align: center;'>
                                        <select class="form-control" name="cmbImpuesto" id="cmbImpuesto">
                                            <option value="">-- Seleccione un Impuesto --</option>
                                            <!--Rellenado mediante BD-->
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                            <?php
                                            $sql = "SELECT Id_Impuesto, Nombre_Impuesto FROM v_Impuesto WHERE Id_Impuesto = 3";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Id_Impuesto'] . "'>" . $row['Nombre_Impuesto'] . "</option>";
                                            }
                                            $sql = "SELECT Id_Impuesto, Nombre_Impuesto FROM v_Impuesto WHERE Valor_Impuesto <> 0.0000";
                                            $result = mysqli_query($conexion, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['Id_Impuesto'] . "'>" . $row['Nombre_Impuesto'] . "</option>";
                                            }
                                            ?>
                                            <!-------------------------------------------------------------------------------------------------------------------------------------->
                                        </select>
                                    </td>
                                    <td scope='row' style='text-align: center;'></td>
                                    <td scope='row' style='text-align: center;'>
                                        <button onclick="return revisarProducto()" type="button" name="btnDetalle" id="btnDetalle" class="btn btn-primary mx-3 mb-1" style="background-color: #6AB759; border-color: #6AB759;">+</button>
                                        <!--Llama a la funcion para el llenado de el input escondido accion y el submit del form para la insercion del detalle-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                    <?php
                    if ($_POST["apertura"] == 'apertura') { //Cuando la factura ya ha sido abierta en la BD calcula subtotal y total para su impresion en pantalla
                        $sql = "SELECT CalcularSubtotal('" . $_POST["txtNoFactura"] . "')";
                        $subtotal = 0;
                        $result = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $subtotal = $row["CalcularSubtotal('" . $_POST["txtNoFactura"] . "')"];
                        }
                        $sql = "SELECT CalcularTotal('" . $_POST["txtNoFactura"] . "')";
                        $total = 0;
                        $result = mysqli_query($conexion, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $total = $row["CalcularTotal('" . $_POST["txtNoFactura"] . "')"];
                        }
                    }
                    ?>
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
                                <input type="text" class="form-control" name="txtCliente" id="txtCliente" placeholder="Ingrese el número de identidad del cliente" <?php echo "value='" . $_POST['txtCliente'] . "'" ?>>
                            </div>
                        </div>
                        <!--Metodo de Pago-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbMetodoPago" class="form-label">Método de Pago</label>
                                <select class="form-control" name="cmbMetodoPago" id="cmbMetodoPago">
                                    <option value="">-- Seleccione un Método de Pago --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Metodo_Pago, Metodo_Pago FROM Metodos_Pago";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Metodo_Pago'] == $_POST['cmbMetodoPago']) {
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

                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <button onClick="return validarPrefactura()" name="btnLimpiar" id="btnLimpiar" class="btn btn-secondary m-5" style="background-color: #97AF6C; border-color: #97AF6C;">Prefacturar</button>
                                <button onClick="return revisarIdentidad()" name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Facturar</button>
                                <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <footer>
        <div style="background-color: #24242c; width: 1481px; height: 58px;"></div>
    </footer>
</body>

</html>