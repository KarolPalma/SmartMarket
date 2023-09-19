<?php
session_start();
include('../../php/conexion.php');
if (isset($_SESSION["idUsuario"])) {
    $sql = "SELECT Administrador FROM Usuarios WHERE Id_Usuario = '" . $_SESSION["idUsuario"] . "'";
    $result = mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $admin = $row["Administrador"];
        $_SESSION["admin"] = $row["Administrador"];
    }
}
//Recupera el valor del campo administrador del usuario que inicio sesion para determinar las funciones del menu a las que podra acceder
$logout = isset($_POST["logout"]) ? $_POST["logout"] : ""; //Recupera la accion
if ($logout == "salir") { //Si paso se preciono el boton de Logout tendra el boton salir y sino estara vacio
    session_destroy();
    echo "<script>
            window.location.href = '../../forms/principal/login.php';
        </script>";
}

if (isset($_SESSION["idUsuario"])) { //Esto evita que se pueda regresar al sistema con el boton de regresar del navegador una vez se haya destruido la sesion
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link href="../../recursos/sm.ico" rel="shortcut icon" type="image/x-icon">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Utiliza las librerias de Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            .dropdown-item {
                color: white;
            }

            .dropdown-item:hover {
                background-color: #6AB759;
            }
        </style>
        <!--Colores del menu-->
        <script>
            function salir() {
                document.getElementById('logout').value = 'salir';
                document.getElementById('salir').submit();
                return false;
            }
        </script>
    </head>

    <body>
        <!--Clases de Bootstrap para el estilo del menu-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" style="margin-left: 20px;" href="../../forms/principal/principal.php">Smart Market</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!--Inicio-->
                    <li class="nav-item active">
                        <a class="nav-link" href="../../forms/principal/principal.php">Inicio</span></a>
                    </li>
                    <!--Facturacion-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Facturación
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" style="color: white;" href="../../forms/facturas/form_insertarFactura.php">Facturar Productos</a>
                            <?php
                            if ($admin == 1) { //Si no es administrador no puede entrar a esta funcion, por lo que no se muestra en el menu
                            ?>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/facturas/form_filtroFactura.php">Búsqueda</a>

                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    <?php
                    if ($admin == 1) { //Solo podra ver estas opciones si el usuario es administrador
                    ?>
                        <!--Clientes-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Clientes
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/clientes/form_insertarCliente.php">Registrar Cliente</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/clientes/form_filtroCliente.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Productos-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Productos
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/productos/form_insertarProducto.php">Nuevo Producto</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/productos/form_filtroProducto.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Categorias-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/categorias/form_insertarCategoria.php">Nueva Categoría</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/categorias/form_filtroCategoria.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Proveedores-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Proveedores
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/proveedores/form_insertarProveedor.php">Añadir a un Proveedor</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/proveedores/form_filtroProveedor.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Impuestos-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Impuestos
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/impuestos/form_insertarImpuesto.php">Añadir un Impuesto</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/impuestos/form_filtroImpuesto.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Descuentos-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Descuentos
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/descuentos/form_insertarDescuento.php">Añadir un Descuento</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/descuentos/form_filtroDescuento.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Empleados-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Empleados
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/empleados/form_insertarEmpleado.php">Añadir un Empleado</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/empleados/form_filtroEmpleado.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Usuarios-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Usuarios
                            </a>
                            <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" style="color: white;" href="../../forms/usuarios/form_insertarUsuario.php">Añadir un Usuario</a>
                                <div class="dropdown-divider" style="background-color: white;"></div>
                                <a class="dropdown-item" style="color: white;" href="../../forms/usuarios/form_filtroUsuario.php">Búsqueda</a>
                            </div>
                        </li>
                        <!--Bitacora-->
                        <li class="nav-item active">
                            <a class="nav-link" href="../../forms/bitacora/form_filtroBitacora.php">Bitacora</span></a>
                        </li>
                </ul>
            <?php
                    } //Cierre de if
            ?>
            <form class="form-inline my-2 my-lg-0" id="salir" method="POST" action="">
                <input type="hidden" name='logout' id="logout" value="">
                <?php
                if ($admin == 1) { //Condicion para dar estilo al boton del menu, para los usuarios normales debe de tener un mayor margen a la izquierda
                ?>
                    <button onclick="return salir()" class="btn btn-outline-success" style="margin-left: 130px;">Logout</button>
                <?php
                }
                ?>
                <?php
                if ($admin == 0) {
                ?>
                    <button onclick="return salir()" class="btn btn-outline-success" style="margin-left: 1060px;">Logout</button>
                <?php
                }
                ?>
            </form>
            </div>
        </nav>
        <!--Scripts adicionales para el funcionamiento de los dropdown del menu-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else { //Pagina que se carga cuando se trata de acceder una vez destruida la sesion, lleva a la pagina del login
    echo "<script>
            window.location.href = '../../forms/principal/login.php';
        </script>";
}
?>