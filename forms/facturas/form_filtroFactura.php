<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
if ($_SESSION["admin"] == 1) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="../../recursos/bus.ico" rel="shortcut icon" type="image/x-icon">
        <title>Facturas Registradas - Smart Market</title>
        <!--Scripts-->
        <script type="text/javascript">
            function validar() {
                if (document.getElementById('txtNoFactura').value == '' && document.getElementById('dtefechaInicio').value == '' && document.getElementById('cmbAnulada').value == '') {
                    if (document.getElementById('dtefechaFin').value == '') {
                        alert('Por favor añada un filtro de búsqueda');
                    } else {
                        alert('Para filtrar por rango de fecha debe añadir una fecha de inicio');
                    }
                } else {
                    if (document.getElementById('dtefechaInicio').value > document.getElementById('dtefechaFin').value) {
                        alert("La fecha de inicio de búsqueda debe ser menor a la fecha de fin de búsqueda");
                    } else {
                        document.getElementById("accion").value = "consultar"; //Al cambiar este valor, el incrutado PHP entra a la condicion
                        document.getElementById("formulario").submit(); //Al hacer submit PHP puede recuperar los valores POST necesarios abajo

                    }
                }
                return false;
            }
        </script>
        <!--Fin Scripts-->
    </head>

    <body>

        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Filtrar Facturas</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <div class="col-12">
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                    <div class="row">
                        <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                        <!--No Factura-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNoFactura" class="form-label">No. de Factura</label>
                                <input type="text" class="form-control" name="txtNoFactura" id="txtNoFactura" placeholder="Ingrese el número de la factura">
                                <!--Un campo de solo lectura que tiene como valor la identidad traida del metodo GET-->
                            </div>
                        </div>
                        <!--Fecha de Inicio-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="dtefechaInicio" class="form-label">Fecha de Facturación o Inicio de Búsqueda</label>
                                <input type="date" class="form-control" name="dtefechaInicio" id="dtefechaInicio" value="">
                            </div>
                        </div>
                        <!--Fecha de Fin-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="dtefechaFin" class="form-label">Fecha de Fin de Búsqueda (Opcional)</label>
                                <input type="date" class="form-control" name="dtefechaFin" id="dtefechaFin" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                        <!--Anulada-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="cmbAnulada" class="form-label">Estado</label>
                                <select class="form-control" name="cmbAnulada" id="cmbAnulada">
                                    <option value="">-- Seleccione un Estado --</option>
                                    <option value="0">No Anulada</option>
                                    <option value="1">Anulada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <?php
                            $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                            if ($accion == "consultar") {
                                echo "<a class='btn btn-secondary m-3' href='form_filtroFactura.php'> Regresar</a>";
                            }
                            ?>
                            <button onClick="return validar()" name="btnBuscar" id="btnBuscar" class="btn btn-primary m-3" style="background-color: #6AB759; border-color: #6AB759;">Buscar</button>
                            <!--Utiliza el script especificado en el head para validar que el campo no este vacio y hacer submit-->
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-center my-4">
            <!--Bootstrap: Centrado de div-->
            <table id='tabla' class="table table-striped table-bordered" style="max-width: 1100px;">
                <!--Bootstrap: Estilo de tabla-->
                <?php
                $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                $idFactura = isset($_POST["txtNoFactura"]) ? $_POST["txtNoFactura"] : "";
                $fechainicio = isset($_POST["dtefechaInicio"]) ? $_POST["dtefechaInicio"] : "";
                $fechafin = isset($_POST["dtefechaFin"]) ? $_POST["dtefechaFin"] : "";
                $anulada = isset($_POST["cmbAnulada"]) ? $_POST["cmbAnulada"] : "";
                if ($accion == "consultar") {
                    $sql = '';
                    if ($idFactura != '') {
                        $sql = "SELECT * FROM v_Facturas WHERE Id_Factura = '$idFactura' ";
                    }
                    if ($anulada != '') {
                        if ($sql == "") {
                            if ($anulada == 1) {
                                $sql = "SELECT * FROM v_Facturas WHERE Fecha_Anulacion <> ''";
                            } else {
                                $sql = "SELECT * FROM v_Facturas WHERE Fecha_Anulacion = ''";
                            }
                        } else {
                            if ($anulada == 0) {
                                $sql = $sql . " AND Fecha_Anulacion = ''";
                            } else {
                                $sql = $sql . " AND Fecha_Anulacion <> ''";
                            }
                        }
                    }
                    if ($fechainicio != '') {
                        if ($sql == "") {
                            $sql = "SELECT * FROM v_Facturas WHERE Fecha_Factura >= '$fechainicio' ";
                        } else {
                            $sql = $sql . " AND Fecha_Factura >= '$fechainicio'";
                        }
                    }
                    if ($fechafin != '') {
                        if ($fechainicio != '') {
                            $sql = $sql . " AND Fecha_Factura <= '$fechafin'";
                        }
                    }
                    $sql = $sql . " ORDER BY Id_Factura";
                    //La consulta se realizara de acuerdo a los filtros proporcionados, concatenanadolos si es necesario.
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>No. Factura</th>
                            <th scope='col'>Fecha</th>
                            <th scope='col'>Hora</th>
                            <th scope='col'>Identidad del Cliente</th>
                            <th scope='col' style='text-align: right'>Total</th>
                            <th scope='col'>Estado</th>
                            <th style='text-align: center;' scope='col'>Visualizar Factura</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            if ($row["Fecha_Anulacion"] == '') {
                                $estado = 'No Anulada';
                            } else {
                                $estado = 'Anulada';
                            }

                            if ($row["Id_Cliente"] == 0) {
                                $cliente = 'CONSUMIDOR FINAL';
                            } else {
                                $cliente = $row["Id_Cliente"];
                            }
                            echo
                            "<tr>
						<th scope='row'>" . $row["Id_Factura"] . "</th>
						<td>" . date('d-m-Y', strtotime($row["Fecha_Factura"])) . "</td>
                        <td>" . date('h:i a', strtotime($row["Hora_Factura"])) . "</td>
                        <td>" . $cliente . "</td>
                        <td style='text-align: right'>L. " . $row["Total"] . "</td>
                        <td>" . $estado . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_vistaFactura.php?idFactura=" . $row["Id_Factura"] . "'> Visualizar</a></td>
					    </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Registro
                        }
                    }
                    echo "</table>"; //Cerrado de tabla
                    if (mysqli_num_rows($result) == 0) { //Si la respuesta no contiene ningun registro, imprime que no hay resultados
                        echo
                        "<div class='col-12 text-center mt-5 mb-5'>
                        <p>No se encontraron resultados</p>
                    </div>";
                    }
                } else {
                    $sql = "SELECT * FROM v_Facturas";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>No. Factura</th>
                            <th scope='col'>Fecha</th>
                            <th scope='col'>Hora</th>
                            <th scope='col'>Identidad del Cliente</th>
                            <th scope='col' style='text-align: right'>Total</th>
                            <th scope='col'>Estado</th>
                            <th style='text-align: center;' scope='col'>Visualizar Factura</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            if ($row["Fecha_Anulacion"] == '') {
                                $estado = 'No Anulada';
                            } else {
                                $estado = 'Anulada';
                            }

                            if ($row["Id_Cliente"] == 0) {
                                $cliente = 'CONSUMIDOR FINAL';
                            } else {
                                $cliente = $row["Id_Cliente"];
                            }
                            echo
                            "<tr>
						<th scope='row'>" . $row["Id_Factura"] . "</th>
						<td>" . date('d-m-Y', strtotime($row["Fecha_Factura"])) . "</td>
                        <td>" . date('h:i a', strtotime($row["Hora_Factura"])) . "</td>
                        <td>" . $cliente . "</td>
                        <td style='text-align: right'>L. " . $row["Total"] . "</td>
                        <td>" . $estado . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_vistaFactura.php?idFactura=" . $row["Id_Factura"] . "'> Visualizar</a></td>
					    </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Registro
                        }
                    }
                    echo "</table>"; //Cerrado de tabla
                }
                ?>
                </tbody>
            </table>
        </div>
        <br>
        <footer style="clear: both; position: relative; margin-top: 150px;">
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