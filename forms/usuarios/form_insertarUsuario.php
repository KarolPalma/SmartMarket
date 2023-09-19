<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/usuarios/insertarUsuario.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Insertar Usuario - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/usuarios/usuarios.js"></script>
        <!--Script de validación de campos-->
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #6AB759; color: white;">Insertar Usuario</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Accion que será cambiada por la funcion validar en usuarios.js-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Bootstrap: Divide en filas la pagina-->
                        <!--Identidad-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <label for="txtUsuario" class="form-label">Usuario</label>
                                <input type="number" class="form-control" name="txtUsuario" id="txtUsuario" min="1" max='2147483648' placeholder="Ingrese el usuario numérico" value="">
                            </div>
                        </div>
                        <!--Empleado-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbEmpleado" class="form-label">Empleado</label>
                                <select class="form-control" name="cmbEmpleado" id="cmbEmpleado">
                                    <option value="">-- Seleccione un Empleado --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Empleado, Nombres, Apellidos FROM Empleados WHERE Activo = 1
                                        AND Id_Empleado NOT IN (SELECT Id_Empleado FROM Usuarios)";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Empleado'] . "'>" . $row['Nombres'] . " " . $row['Apellidos'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Clave-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtClave" class="form-label">Clave</label>
                                <input type="password" class="form-control" name="txtClave" id="txtClave" maxlength="45" placeholder="Ingrese la clave del usuario" value="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                        <!--Tipo de Usuario-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbTipo" class="form-label">Tipo de Usuario</label>
                                <select class="form-control" name="cmbTipo" id="cmbTipo">
                                    <option value="">-- Seleccione un Tipo --</option>
                                    <option value='0'>Normal</option>
                                    <option value='1'>Administrador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <button name="btnLimpiar" id="btnLimpiar" class="btn btn-secondary m-5">Limpiar</button>
                            <button onClick="return revisarUsuario()" name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Guardar</button>
                            <!--El boton llama a la funcion de revision donde si las validaciones son correctas se hará el submit-->
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