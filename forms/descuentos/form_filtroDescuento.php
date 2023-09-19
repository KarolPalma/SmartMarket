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
        <title>Filtro de Descuentos - Smart Market</title>
        <!--Scripts-->
        <script type="text/javascript">
            function validar() {
                if (document.getElementById("txtIdDescuento").value == "") {
                    alert("Favor Ingrese el ID del descuento");
                    document.getElementById("txtIdDescuento").focus();
                } else {
                    document.getElementById("accion").value = "consultar"; //Al cambiar este valor, el incrutado PHP entra a la condicion
                    document.getElementById("formulario").submit(); //Al hacer submit PHP puede recuperar los valores POST necesarios abajo
                }
                return false;
            }
        </script>
        <!--Fin Scripts-->
    </head>

    <body>

        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Filtrar Descuentos</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <div class="col-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                        <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                        <!--Id del Descuento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="txtIdDescuento" class="form-label">Id del Descuento</label>
                                <input type="text" class="form-control" name="txtIdDescuento" id="txtIdDescuento" maxlength="15" placeholder="Ingrese el Id del descuento" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <?php
                            $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                            if ($accion == "consultar") {
                                echo "<a class='btn btn-secondary m-3' href='form_filtroDescuento.php'> Regresar</a>";
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
                $idDescuento = isset($_POST["txtIdDescuento"]) ? $_POST["txtIdDescuento"] : "";
                if ($accion == "consultar") {
                    $sql = "SELECT * FROM Descuentos WHERE Id_Descuento = '$idDescuento'";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>Id del Descuento</th>
                            <th scope='col'>Nombre del Descuento</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            echo
                            "<tr>
						<th scope='row'>" . $row["Id_Descuento"] . "</th>
						<td>" . $row["Nombre_Descuento"] . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_actualizarDescuento.php?idDescuento=" . $row["Id_Descuento"] . "'> Actualizar Descuento</a></td>
					    </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Descuento
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
                    $sql = "SELECT * FROM Descuentos";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>Id del Descuento</th>
                            <th scope='col'>Nombre del Descuento</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                    </thead>
                    <tbody>";
                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            echo
                            "<tr>
                        <th scope='row'>" . $row["Id_Descuento"] . "</th>
                        <td>" . $row["Nombre_Descuento"] . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_actualizarDescuento.php?idDescuento=" . $row["Id_Descuento"] . "'> Actualizar Descuento</a></td>
                        </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Descuento
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