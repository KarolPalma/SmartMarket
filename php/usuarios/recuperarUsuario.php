<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del usuario seleccionado desde la base de datos
    $id = $_GET['idUsuario']; //Recupera el usuario que fue enviado por metodo GET desde el filtro de usuario

    //Inicializacion de variables
    $idEmpleado = '';
    $clave = '';
    $registro = '';
    $actualizacion = '';
    $admin = '';
    $activo = '';
    $sql = "SELECT * FROM v_Usuario WHERE Id_Usuario = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del usuario
    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $idEmpleado = $row["Id_Empleado"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $clave = $row["Clave"];
        $registro = $row["Fecha_Registro"];
        $actualizacion = $row["Ultima_Fecha_Actualizacion"];
        $admin = $row["Administrador"];
        $activo = $row["Activo"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de usuarios, es posible llamar a estas variables en cada campo
?>