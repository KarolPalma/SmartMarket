<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/productos/insertarProducto.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Insertar Producto - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/productos/productos.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #6AB759; color: white;">Insertar Producto</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Accion que será cambiada por la funcion validar en productos.js-->
                <!--Modificar usuario a POST cuando se tenga la variable de sesion de usuario (luego del login)-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Bootstrap: Divide en filas la pagina-->
                        <!--Id. Producto-->
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <label for="txtIdProducto" class="form-label">Id. del Producto</label>
                                <input type="text" class="form-control" name="txtIdProducto" id="txtIdProducto" maxlength="15" placeholder="Ingrese el Id. del producto" value="">
                            </div>
                        </div>
                        <!--Nombre del Producto-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombre" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" maxlength="45" placeholder="Ingrese el nombre del producto" value="">
                            </div>
                        </div>
                        <!--Descripción-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtDescripcion" class="form-label">Descripción</label>
                                <textarea rows="4" cols="50" class="form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Ingrese la descripción del producto"></textarea>
                            </div>
                        </div>
                        <!--Categoría-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbCategoria" class="form-label">Categoría</label>
                                <select class="form-control" name="cmbCategoria" id="cmbCategoria">
                                    <option value="">-- Seleccione una Categoría --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Categoria, Categoria FROM Categorias WHERE Activo = 1";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Categoria'] . "'>" . $row['Categoria'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Proveedor-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbProveedor" class="form-label">Proveedor</label>
                                <select class="form-control" name="cmbProveedor" id="cmbProveedor">
                                    <option value="">-- Seleccione un Proveedor --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Proveedor, Nombre_Proveedor FROM Proveedores WHERE Activo = 1";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Proveedor'] . "'>" . $row['Nombre_Proveedor'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Cantidad Unidad-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCantidad" class="form-label">Cantidad por unidad</label>
                                <input type="text" class="form-control" name="txtCantidad" id="txtCantidad" value="" maxlength="20" placeholder="Ingrese la cantidad por unidad">
                            </div>
                        </div>
                        <!--Unidad Almacen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtUnidad" class="form-label">Unidad en almacen</label>
                                <input type="number" class="form-control" name="txtUnidad" id="txtUnidad" value="" placeholder="Ingrese la unidad en almacen">
                            </div>
                        </div>
                        <!--Cantidad Mínima-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCantidadMin" class="form-label">Cantidad Mínima</label>
                                <input type="number" class="form-control" name="txtCantidadMin" id="txtCantidadMin" value="" placeholder="Ingrese la cantidad mínima">
                            </div>
                        </div>
                        <!--Cantidad Máxima-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCantidadMax" class="form-label">Cantidad Máxima</label>
                                <input type="number" class="form-control" name="txtCantidadMax" id="txtCantidadMax" value="" placeholder="Ingrese la cantidad máxima">
                            </div>
                        </div>
                        <!--Precio-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtPrecios" class="form-label">Precio</label>
                                <div class="form-inline">
                                    <p style="float: left; margin-top: 6px;">L.</p>
                                    <p style="float: left; width: 20px;"></p>
                                    <input type="number" class="form-control" style="max-width: 380px; float: left;" name="txtPrecios" id="txtPrecios" maxlength="10" placeholder="Ingrese el precio del producto" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <button name="btnLimpiar" id="btnLimpiar" class="btn btn-secondary m-5">Limpiar</button>
                                <button onClick="return revisarIdProducto()" name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Guardar</button>
                                <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
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
<?php
} else { //Pagina que se carga cuando se trata de acceder con la url sin ser administrador
    echo "<script>
            window.location.href = '../../forms/principal/principal.php';
        </script>";
}
?>