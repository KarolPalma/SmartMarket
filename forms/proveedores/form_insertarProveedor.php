<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/proveedores/insertarProveedor.php");
//Incluye el archivo php que inserta los datos a la BD cuando se cambia el campo de "accion" al valor de guardar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Insertar Proveedor - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/proveedores/proveedores.js"></script>
        <!--Script de validación de campos-->
        <script src="../../js/paises/paises.js"></script>
        <!--Script de actualización en tiempo real de selects de departamentos y ciudades-->
        <script src="../../js/telefonos_correos/telefonosDinamicos.js"></script>
        <!--Script de div de telefonos dinamicos y su traspaso al campo escondido "arrayTelefonos" para guardado-->
        <script src="../../js/telefonos_correos/correosDinamicos.js"></script>
        <!--Script de div de correos dinamicos y su traspaso al campo escondido "arrayCorreos" para guardado-->
    </head>

    <body>
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <!--Bootstrap: Centrado de Texto y margenes arriba y abajo-->
                <h3 style="background-color: #6AB759; color: white;">Insertar Proveedor</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <!--Accion que será cambiada por la funcion validar en clientes.js-->
                <input type="hidden" name="arrayTelefonos" id="arrayTelefonos" value="">
                <!--Será llenado al dar click al botón de guardar mediante telefonosDinamicos.js-->
                <input type="hidden" name="arrayCorreos" id="arrayCorreos" value="">
                <!--Será llenado al dar click al botón de guardar mediante CorreosDinamicos.js-->
                <!--Modificar usuario a POST cuando se tenga la variable de sesion de usuario (luego del login)-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Bootstrap: Divide en filas la pagina-->
                        <!--No. Proveedor-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!--Bootstrap: Divide en columnas la fila, de 12 columnas este div esta destinado a abarcar 4 columnas-->
                            <div class="form-group mt-2 mb-2">
                                <?php $sql = "SELECT (COUNT(*) + 1) AS C FROM Proveedores";
                                $noProveedor = 0;
                                $result = mysqli_query($conexion, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $noProveedor = $row["C"];
                                } ?>
                                <!--Bootstrap: Aplica CSS al label e input, añade margen arriba y abajo-->
                                <label for="txtNoProveedor" class="form-label">No. Proveedor</label>
                                <input type="text" class="form-control" name="txtNoProveedor" id="txtNoProveedor" maxlength="45" <?php echo "value='$noProveedor'"; ?> readonly>
                            </div>
                        </div>
                        <!--Nombre-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombreProveedor" class="form-label">Nombre del Proveedor</label>
                                <input type="text" class="form-control" name="txtNombreProveedor" id="txtNombreProveedor" maxlength="45" placeholder="Ingrese el nombre del proveedor" value="">
                            </div>
                        </div>
                        <!--Contacto-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtContacto" class="form-label">Nombre del Personal de Contacto</label>
                                <input type="text" class="form-control" name="txtContacto" id="txtContacto" maxlength="45" placeholder="Ingrese el nombre del contacto para el proveedor" value="">
                            </div>
                        </div>

                        <!--Pais-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbPais" class="form-label">País</label>
                                <select class="form-control" name="cmbPais" id="cmbPais">
                                    <option value="">-- Seleccione un País --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Pais, Nombre_Pais FROM Paises";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Departamento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="depto">
                                <label for='cmbDepto' class='form-label'>Departamento</label>
                                <select class='form-control' name='cmbDepto' id='cmbDepto'>
                                    <!--Se rellena mediante script paises.js, funcion cargarDepartamentos()-->
                                </select>
                            </div>
                        </div>
                        <!--Ciudad-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2" id="ciudad">
                                <label for='cmbCiudad' class='form-label'>Ciudad</label>
                                <select class='form-control' name='cmbCiudad' id='cmbCiudad'>
                                    <!--Se rellena mediante scrip paises.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>
                        <!--Dirección-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtDireccion" class="form-label">Dirección</label>
                                <textarea rows="4" cols="50" class="form-control" name="txtDireccion" id="txtDireccion" placeholder="Ingrese la dirección del proveedor"></textarea>
                            </div>
                        </div>
                        <!--Correo-->
                        <div class="row" id="correos">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group mt-2 mb-2">
                                    <label for="txtEmail1" class="form-label">Correo Electrónico</label>
                                    <input style="float: left;" type="email" class="form-control" name="txtEmail1" id="txtEmail1" maxlength="45" placeholder="Ingrese el correo electrónico del cliente" value="">
                                    <button type="button" name="add" id="btn_anadirCorreo" class="btn btn-primary mx-3 mb-1" style="background-color: #6AB759; border-color: #6AB759;">+</button>
                                </div>
                            </div>
                            <!--Al precionar el btn_anadirCorreo se invocará una funcion de correosDinamicos.js que pondrá aqui la cadena HTML retornada-->
                        </div>
                        <!--Telefonos-->
                        <div class="row" id="telefonos">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                                <div class="form-group mt-2 mb-2">
                                    <label for="txtTelefono1" class="form-label">Número Teléfonico</label>
                                    <input style="float: left;" type="text" class="form-control" name="txtTelefono1" id="txtTelefono1" maxlength="10" placeholder="Ingrese el teléfono del cliente" value="">
                                    <button type="button" name="add" id="btn_anadirTelefono" class="btn btn-primary mx-3 mb-1" style="background-color: #6AB759; border-color: #6AB759;">+</button>
                                </div>
                            </div>
                            <!--Al precionar el btn_anadirTelefono se invocará una funcion de telefonosDinamicos.js que pondrá aqui la cadena HTML retornada-->
                        </div>
                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <button name="btnLimpiar" id="btnLimpiar" class="btn btn-secondary m-5">Limpiar</button>
                                <button name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Guardar</button>
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