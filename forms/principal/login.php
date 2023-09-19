<?php
session_start();
include("../../php/conexion.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="../../recursos/sm.ico" rel="shortcut icon" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login - Smart Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="../../js/jquery-1.10.2.min.js"></script>
    <script src="../../js/principal/login.js"></script>
</head>

<body>
    <div class="container">
        <br><br><br><br><br>
        <div class="col-12 text-center mt-3 mb-3">
            <img src="../../recursos/sm.png" alt="Logo de Smart Market" style="max-width: 150px;">
        </div>
        <div class="col-12 text-center mt-3 mb-5">
            <h3>Login</h3>
        </div>
        <form name='formulario' id='formulario' method='POST' action="login.php">
            <input type="hidden" name="respuesta" id="respuesta" <?php echo 'value=' . $_POST["respuesta"] ?>>
            <!--Se llena mediante login.js con un 0 o un 1 dependiendo de si el usuario es invalido o valido respectivamente-->
            <div class="col-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                    <!--Usuario-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group mt-2 mb-2">
                            <label for="txtUsuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" name="txtUsuario" id="txtUsuario" maxlength="45" placeholder="Ingrese su Usuario" <?php echo 'value=' . $_POST["txtUsuario"] ?>>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>

                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4"></div>
                    <!--Clave-->
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                        <div class="form-group mt-2 mb-2">
                            <label for="txtPass" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="txtPass" id="txtPass" maxlength="45" placeholder="Contraseña del usuario" <?php echo 'value=' . $_POST["txtPass"] ?>>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"></div>

                    <div class="row">
                        <!--Botones-->
                        <div class="d-flex justify-content-center">
                            <button name="btnGuardar" id="btnGuardar" class="btn btn-primary m-5" style="background-color: #6AB759; border-color: #6AB759;" onclick="return corroborarUsuario()">Ingresar</button>
                        </div>
                    </div>
                </div>
        </form>
        <?php
        $_SESSION["idUsuario"] = $_POST["txtUsuario"];
        if ($_POST["respuesta"] == 1 && $_SESSION["idUsuario"] != '') { //Si es 1 el usuario es valido, por lo que se redireccionara al menu principal de la aplicacion.
            echo "<script>document.getElementById('formulario').action = 'principal.php'; document.getElementById('formulario').submit();</script>";
        }
        ?>
    </div>
</body>

</html>