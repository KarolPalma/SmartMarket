<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/productos/recuperarProducto.php");
//Incluye el archivo php que recupera los datos de la BD mediante una vista para utilizar esos valores en los campos
include("../../php/productos/actualizarProducto.php");
//Incluye el archivo php que actualiza o desactiva producto en la BD cuando se cambia el campo de "accion" al valor de guardar o desactivar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Actualizar Producto - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/productos/productos.js"></script>
    </head>

    <body>
        <!--Tanto los valores de Bootstrap como los de las variables escondidas se explican en el form_insertarProducto.php-->
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Actualizar Producto</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Modificar usuario a POST-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Identidad-->
                        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2"></div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtIdProducto" class="form-label">Id. del Producto</label>
                                <input type="text" class="form-control" name="txtIdProducto" id="txtIdProducto" maxlength="15" placeholder="Ingrese el ID del Producto" <?php echo 'value=' . $_GET['idProducto'] ?> readonly>
                                <!--Un campo de solo lectura que tiene como valor la ID traida del metodo GET-->
                            </div>
                        </div>
                        <!--Nombres-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombre" class="form-label">Nombre del Producto</label>
                                <input type="text" class="form-control" name="txtNombre" id="txtNombre" maxlength="45" placeholder="Ingrese el nombre del producto" <?php echo "value='$nombre'" ?>>
                                <!--Campo que utiliza la variable de nombre de recuperarProducto.php-->
                            </div>
                        </div>
                        <!--Descripción-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtDescripcion" class="form-label">Descripción</label>
                                <textarea rows="4" cols="50" class="form-control" name="txtDescripcion" id="txtDescripcion" placeholder="Ingrese la descripción del producto"><?php echo "" . $descripcion ?></textarea>
                                <!--Campo que utiliza la variable de descripción de recuperarProducto.php-->
                            </div>
                        </div>
                        <!--Categoría-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbCategoria" class="form-label">Género</label>
                                <select class="form-control" name="cmbCategoria" id="cmbCategoria">
                                    <option value="">-- Seleccione un Categoría --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Categoria, Categoria FROM Categorias";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Categoria'] == $idCategoria) { //Si el id de la respuesta concuerda con el id de recuperarProducto.php, lo setea como seleccionado
                                            echo "<option selected value='" . $row['Id_Categoria'] . "'>" . $row['Categoria'] . "</option>";
                                        } else { //Y si no, lo imprime como no seleccionado
                                            echo "<option value='" . $row['Id_Categoria'] . "'>" . $row['Categoria'] . "</option>";
                                        }
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
                                    $sql = "SELECT Id_Proveedor, Nombre_Proveedor FROM Proveedores";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Proveedor'] == $idProveedor) { //Si el id de la respuesta concuerda con el id de recuperarProducto.php, lo setea como seleccionado
                                            echo "<option selected value='" . $row['Id_Proveedor'] . "'>" . $row['Nombre_Proveedor'] . "</option>";
                                        } else { //Y si no, lo imprime como no seleccionado
                                            echo "<option value='" . $row['Id_Proveedor'] . "'>" . $row['Nombre_Proveedor'] . "</option>";
                                        }
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
                                <input type="text" class="form-control" name="txtCantidad" id="txtCantidad" maxlength="20" placeholder="Ingrese la cantidad por unidad" <?php echo "value='$cantidad'" ?>>
                                <!--Campo que utiliza la variable de cantidad de recuperarProducto.php-->
                            </div>
                        </div>
                        <!--Unidad Almacen-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtUnidad" class="form-label">Unidad en almacen</label>
                                <input type="number" class="form-control" name="txtUnidad" id="txtUnidad" maxlength="45" placeholder="Ingrese la unidad en almacen" <?php echo 'value=' . $unidad ?>>
                                <!--Campo que utiliza la variable de unidad en almacen de recuperarProducto.php-->
                            </div>
                        </div>
                        <!--Cantidad Mínima-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCantidadMin" class="form-label">Cantidad Mínima</label>
                                <input type="number" class="form-control" name="txtCantidadMin" id="txtCantidadMin" maxlength="45" placeholder="Ingrese la cantidad mínima" <?php echo 'value=' . $cantidadMin ?>>
                                <!--Campo que utiliza la variable de cantidad minima de recuperarProducto.php-->
                            </div>
                        </div>
                        <!--Cantidad Máxima-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCantidadMax" class="form-label">Cantidad Máxima</label>
                                <input type="number" class="form-control" name="txtCantidadMax" id="txtCantidadMax" maxlength="45" placeholder="Ingrese la cantidad máxima" <?php echo 'value=' . $cantidadMax ?>>
                                <!--Campo que utiliza la variable de cantidad máxima de recuperarProducto.php-->
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
                                    <input type="number" class="form-control" style="max-width: 380px; float: left;" name="txtPrecios" id="txtPrecios" maxlength="45" placeholder="Ingrese la cantidad máxima" <?php echo 'value=' . $precio ?>>
                                    <!--Campo que utiliza la variable de cantidad máxima de recuperarProducto.php-->
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <?php
                                if ($descontinuado != 1) { //Si el producto no está como descontinuado en la BD el boton será visible, si no, no
                                    echo "<button onClick='return desactivar()' name='btnDesactivar' id='btnDesactivar' class='btn btn-secondary m-5' style='background-color: #F08946; border-color: #F08946;'>Desactivar</button>";
                                    //Llama a la funcion desactivar() de productos.js
                                }
                                ?>
                                <?php
                                if ($descontinuado != 1) { //Si el producto no está como descontinuado en la BD el boton será visible, si no, no
                                    echo "<button onClick='return generar()' name='btnGenerar' id='btnGenerar' class='btn btn-secondary m-5' style='background-color: #97AF6C; border-color: #97AF6C;'>Generar Pedido a Proveedor</button>";
                                    //Llama a la funcion desactivar() de productos.js
                                }
                                ?>
                                <button name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;" onClick="return validar()">Actualizar</button>
                                <!--El boton no llama a ninguna funcion directamente, desde este ultimo se invoca a validar() de productos.js donde se hace el respectivo submit y redireccionamiento al buscador o filtro-->
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