<?php
include("../menu/menu.php");
include("../../php/conexion.php");
//Llama a la conexión a la base de datos mediante conexion.php
include("../../php/empleados/recuperarEmpleado.php");
//Incluye el archivo php que recupera los datos de la BD mediante una vista para utilizar esos valores en los campos
include("../../php/empleados/actualizarEmpleado.php");
//Incluye el archivo php que actualiza o desactiva empleados en la BD cuando se cambia el campo de "accion" al valor de guardar o desactivar
if ($_SESSION["admin"] == 1) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Actualizar Empleado - Smart Market</title>
        <script src="../../js/jquery-1.10.2.min.js"></script>
        <!--Libreria básica de JQuery-->
        <script src="../../js/empleados/empleados.js"></script>
        <!--Script de validación de campos-->
        <script src="../../js/paises/paises.js"></script>
        <!--Script de actualización en tiempo real de selects de departamentos y ciudades-->
        <script src="../../js/telefonos_correos/telefonosDinamicos.js"></script>
        <!--Script de div de telefonos dinamicos y su traspaso al campo escondido "arrayTelefonos" para guardado-->
        <script src="../../js/telefonos_correos/correosDinamicos.js"></script>
        <!--Script de div de correos dinamicos y su traspaso al campo escondido "arrayCorreos" para guardado-->
    </head>

    <body>
        <!--Tanto los valores de Bootstrap como los de las variables escondidas se explican en el form_insertarEmpleado.php-->
        <div class="container">
            <div class="col-12 text-center mt-5 mb-5">
                <h3 style="background-color: #6AB759; color: white;">Actualizar Empleado</h3>
            </div>
            <form name='formulario' id='formulario' method='POST' action="">
                <input type="hidden" name="accion" id="accion" value="">
                <input type="hidden" name="arrayTelefonos" id="arrayTelefonos" value="">
                <input type="hidden" name="arrayCorreos" id="arrayCorreos" value="">
                <!--Modificar usuario a POST-->
                <input type="hidden" name="usuarioLogin" id="usuarioLogin" <?php echo "value='" . $_SESSION["idUsuario"] . "'" ?>>
                <div class="col-12">
                    <div class="row">
                        <!--Identidad-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtIdentidad" class="form-label">No. Identidad del Empleado</label>
                                <input type="text" class="form-control" name="txtIdentidad" id="txtIdentidad" maxlength="15" placeholder="Ingrese la identidad del empleado" <?php echo 'value=' . $_GET['idEmpleado'] ?> readonly>
                                <!--Un campo de solo lectura que tiene como valor la identidad traida del metodo GET-->
                            </div>
                        </div>
                        <!--Nombres-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtNombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" name="txtNombres" id="txtNombres" maxlength="45" placeholder="Ingrese el nombre del empleado" <?php echo "value='$nombres'" ?>>
                                <!--Campo que utiliza la variable de nombres de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Apellidos-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtApellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" name="txtApellidos" id="txtApellidos" maxlength="45" placeholder="Ingrese los apellidos del empleado" <?php echo "value='$apellidos'" ?>>
                                <!--Campo que utiliza la variable de apellidos de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Nacimiento-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="dtefnac" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="dtefnac" id="dtefnac" <?php echo 'value=' . $nacimiento ?>>
                                <!--Campo de fecha que utiliza la variable de nombres de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Fecha de Contratación-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="dtefccont" class="form-label">Fecha de Contratación</label>
                                <input type="date" class="form-control" name="dtefccont" id="dtefccont" <?php echo 'value=' . $registro ?>>
                                <!--Campo de fecha que utiliza la variable de registro de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Fecha de Finalización del Contrato-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="dteffcont" class="form-label">Fecha de Finalización de Contrato</label>
                                <input type="date" class="form-control" name="dteffcont" id="dteffcont" <?php echo 'value=' . $finalizacion ?>>
                                <!--Campo de fecha que utiliza la variable de finalizacion de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Cargo-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtCargo" class="form-label">Cargo</label>
                                <input type="text" class="form-control" name="txtCargo" id="txtCargo" maxlength="45" placeholder="Ingrese el cargo del empleado" <?php echo "value='$cargo'" ?>>
                                <!--Campo que utiliza la variable de cargo de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Reporte A-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbReportaA" class="form-label">Reporta A</label>
                                <select class="form-control" name="cmbReportaA" id="cmbReportaA">
                                    <option value="">-- Seleccione un Empleado --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Empleado, Nombres, Apellidos FROM Empleados WHERE Activo = 1";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Empleado'] == $reportaA) { //Si el id de la respuesta concuerda con el id de recuperarEmpleado.php, lo setea como seleccionado
                                            echo "<option selected value='" . $row['Id_Empleado'] . "'>" . $row['Nombres'] . " " . $row['Apellidos'] . "</option>";
                                        } else { //Y si no, lo imprime como no seleccionado
                                            echo "<option value='" . $row['Id_Empleado'] . "'>" . $row['Nombres'] . " " . $row['Apellidos'] . "</option>";
                                        }
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Genero-->
                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <div class="form-group mt-2 mb-2">
                                <label for="cmbGenero" class="form-label">Género</label>
                                <select class="form-control" name="cmbGenero" id="cmbGenero">
                                    <option value="">-- Seleccione un Género --</option>
                                    <!--Rellenado mediante BD-->
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                    <?php
                                    $sql = "SELECT Id_Genero, Genero FROM Generos";
                                    $result = mysqli_query($conexion, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        if ($row['Id_Genero'] == $idGenero) { //Si el id de la respuesta concuerda con el id de recuperarEmpleado.php, lo setea como seleccionado
                                            echo "<option selected value='" . $row['Id_Genero'] . "'>" . $row['Genero'] . "</option>";
                                        } else { //Y si no, lo imprime como no seleccionado
                                            echo "<option value='" . $row['Id_Genero'] . "'>" . $row['Genero'] . "</option>";
                                        }
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
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
                                        if ($row['Id_Pais'] == $idPais) { //Si el id de la respuesta concuerda con el id de recuperarEmpleado.php, lo setea como seleccionado
                                            echo "<option selected value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                        } else { //Y si no, lo imprime como no seleccionado
                                            echo "<option value='" . $row['Id_Pais'] . "'>" . $row['Nombre_Pais'] . "</option>";
                                        }
                                    }
                                    ?>
                                    <!-------------------------------------------------------------------------------------------------------------------------------------->
                                </select>
                            </div>
                        </div>
                        <!--Estos inputs escondidos sirven para la recuperacion de los valores de departamento y ciudad
                        Ya que no se puede marcar un option como seleccionado desde aqui, debe hacerce desde pais.js
                        donde se mandara el dato en estos inputs para hacer un POST de AJAX e imprimir el valor seleccionado-->
                        <input type="hidden" name="departamento" id="departamento" <?php echo 'value=' . $idDepto ?>>
                        <input type="hidden" name="ciudad" id="ciudad" <?php echo 'value=' . $idCiudad ?>>
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
                                    <!--Se rellena mediante script paises.js, funcion cargarCiudades()-->
                                </select>
                            </div>
                        </div>
                        <!--Dirección-->
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mt-2 mb-2">
                                <label for="txtDireccion" class="form-label">Dirección</label>
                                <textarea rows="4" cols="50" class="form-control" name="txtDireccion" id="txtDireccion" placeholder="Ingrese la dirección del empleado"><?php echo "" . $direccion ?></textarea>
                                <!--Campo que utiliza la variable de direccion de recuperarEmpleado.php-->
                            </div>
                        </div>
                        <!--Correo-->
                        <div class="row" id="correos">
                            <!--Utiliza recuperarCorreos.php para crear los div por cada correo en la BD-->
                            <?php include("../../php/empleados/recuperarCorreos.php"); ?>
                        </div>
                        <!--Telefonos-->
                        <div class="row" id="telefonos">
                            <!--Utiliza recuperarTelefonos.php para crear los div por cada telefono en la BD-->
                            <?php include("../../php/empleados/recuperarTelefonos.php"); ?>
                        </div>
                        <div class="row">
                            <!--Botones-->
                            <div class="d-flex justify-content-center">
                                <?php
                                if ($activo == 1) { //Si el empleado está como activo en la BD el boton será visible, si no, no
                                    echo "<button onClick='return desactivar()' name='btnDesactivar' id='btnDesactivar' class='btn btn-secondary m-5' style='background-color: #F08946; border-color: #F08946;'>Desactivar</button>";
                                    //Llama a la funcion desactivar() de empleados.js
                                }
                                ?>
                                <button name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;">Actualizar</button>
                                <!--El boton no llama a ninguna funcion directamente, sino que se activan las funciones de telefonosDinamicos.js y correosDinamicos.js,
                                desde este ultimo se invoca a validar() de empleados.js donde se hace el respectivo submit y redireccionamiento al buscador o filtro-->
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