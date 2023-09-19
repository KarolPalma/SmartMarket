<?php
include("../menu/menu.php");
include("../../php/conexion.php");
include("../../php/productos/consultarInventario.php");
//Llama a la conexión a la base de datos mediante conexion.php
if ($_SESSION["admin"] == 1) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Filtro de Productos - Smart Market</title>
        <!--Scripts-->
        <script type="text/javascript">
            function validar() {
                if (document.getElementById("txtIdProducto").value == "" && document.getElementById("txtUnidades").value == "" &&
                    document.getElementById("cmbEstado").value == "") {
                    alert("Por favor ingrese un campo de filtrado");
                    document.getElementById("txtIdProducto").focus();
                } else {
                    document.getElementById("accion").value = "consultar"; //Al cambiar este valor, el incrutado PHP entra a la condicion
                    document.getElementById("formulario").submit(); //Al hacer submit PHP puede recuperar los valores POST necesarios abajo
                }
                return false;
            }

            function generar() {
                document.getElementById("accion").value = "generar"; //Al cambiar este valor, el incrutado PHP entra a la condicion
                document.getElementById("formulario").submit();
                return false;
            }
        </script>
        <!--Fin Scripts-->
    </head>

    <body>

        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Filtrar Productos</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <div class="col-12">
                    <div class="row">
                        <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                        <!--Producto-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="txtIdProducto" class="form-label">Id del Producto</label>
                                <input type="text" class="form-control" name="txtIdProducto" id="txtIdProducto" maxlength="15" placeholder="Ingrese el Id del producto" value="">
                            </div>
                        </div>
                        <!--Unidades en Almacen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="txtUnidades" class="form-label">Unidades en Almacén Menores a</label>
                                <input type="number" class="form-control" name="txtUnidades" id="txtUnidades" maxlength="15" min="0" placeholder="Ingrese el rango máximo de unidades en almacen" value="">
                            </div>
                        </div>
                        <!--Estado-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba-->
                                <label for="cmbEstado" class="form-label">Estado</label>
                                <select class="form-control" name="cmbEstado" id="cmbEstado">
                                    <option value="">-- Seleccione un Estado --</option>
                                    <option value="0">Activo</option>
                                    <option value="1">Descontinuado</option>
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
                                echo "<a class='btn btn-secondary m-5' href='form_filtroProducto.php'> Regresar</a>";
                            }
                            ?>
                            <button onClick="return validar()" name="btnBuscar" id="btnBuscar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Buscar</button>
                            <!--Utiliza el script especificado en el head para validar que el campo no este vacio y hacer submit-->
                            <?php
                            $accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //La accion que cambia con la funcion validar()
                            if ($accion != "consultar") {
                                echo "<button onClick='return generar()' name='btnGenerar' id='btnGenerar' class='btn btn-secondary m-5' style='background-color: #97AF6C; border-color: #97AF6C;'>Generar Reporte de Inventario Total</button>";
                            }
                            ?>
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
                $idProducto = isset($_POST["txtIdProducto"]) ? $_POST["txtIdProducto"] : "";
                $unidades = isset($_POST["txtUnidades"]) ? $_POST["txtUnidades"] : "";
                $estadoProducto = isset($_POST["cmbEstado"]) ? $_POST["cmbEstado"] : "";

                if ($accion == "consultar") {
                    $sql = '';
                    if ($idProducto != '') {
                        $sql = "SELECT * FROM Productos WHERE Id_Producto = '$idProducto'";
                    }
                    if ($unidades != '') {
                        if ($sql == "") {
                            $sql = "SELECT * FROM Productos WHERE Unidades_Almacen < '$unidades'";
                        } else {
                            $sql = $sql . " AND Unidades_Almacen < '$unidades'";
                        }
                    }
                    if ($estadoProducto != '') {
                        if ($sql == "") {
                            $sql = "SELECT * FROM Productos WHERE Descontinuado = '$estadoProducto'";
                        } else {
                            $sql = $sql . " AND Descontinuado = '$estadoProducto'";
                        }
                    }
                    $sql = $sql . " ORDER BY Id_Producto";
                    //Dependiendo de los filtros que se hayan llenado se realizara la consulta con concatenaciones de las condiciones
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>Código</th>
                            <th scope='col'>Nombre y Descrípción del Producto</th>
                            <th scope='col'>Uni. Almacén</th>
                            <th scope='col'>Estado</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            if ($row["Descontinuado"] == 1) {
                                $estado = 'Descontinuado';
                            } else {
                                $estado = 'Activo';
                            }
                            echo
                            "<tr>
						<th scope='row'>" . $row["Id_Producto"] . "</th>
						<td>" . $row["Nombre_Producto"] . ", " . $row["Descripcion"] . "</td>
                        <td>" . $row["Unidades_Almacen"] . "</td>
                        <td>" . $estado . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_actualizarProducto.php?idProducto=" . $row["Id_Producto"] . "'> Actualizar</a></td>
					    </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Producto
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
                    $sql = "SELECT * FROM Productos";
                    $result = mysqli_query($conexion, $sql);
                    if (mysqli_num_rows($result) != 0) { //Si la respuesta contiene por lo menos un registro, imprime la tabla
                        echo
                        "<thead>
                        <tr>
                            <th scope='col'>Código</th>
                            <th scope='col'>Nombre y Descrípción del Producto</th>
                            <th scope='col'>Uni. Almacén</th>
                            <th scope='col'>Estado</th>
                            <th style='text-align: center;' scope='col'>Actualizar</th>
                        </tr>
                        </thead>
                        <tbody>";

                        while ($row = mysqli_fetch_assoc($result)) { //Imprime los registros que concuerdan con la consulta $sql
                            if ($row["Descontinuado"] == 1) {
                                $estado = 'Descontinuado';
                            } else {
                                $estado = 'Activo';
                            }
                            echo
                            "<tr>
						<th scope='row'>" . $row["Id_Producto"] . "</th>
						<td>" . $row["Nombre_Producto"] . ", " . $row["Descripcion"] . "</td>
                        <td>" . $row["Unidades_Almacen"] . "</td>
                        <td>" . $estado . "</td>
                        <td style='text-align: center'><a class='btn btn-primary' style='background-color: #6AB759; border-color: #6AB759;' href='form_actualizarProducto.php?idProducto=" . $row["Id_Producto"] . "'> Actualizar</a></td>
					    </tr>"; //El enlace redirecciona al formulario de actualizar, y mediante metodo GET envia el Id del Producto
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