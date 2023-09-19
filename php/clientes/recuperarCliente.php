<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del cliente seleccionado desde la base de datos
    $id = $_GET['idCliente']; //Recupera la identidad del cliente que fue enviada por metodo GET desde el filtro de cliente

    //Inicializacion de variables
    $nombres = '';
    $apellidos = '';
    $nombres = '';
    $registro = '';
    $nacimiento = '';
    $idGenero = '';
    $direccion = '';
    $idPais = '';
    $idDepto = '';
    $idCiudad = '';
    $activo = '';

    $sql = "SELECT * FROM v_Cliente WHERE Id_Cliente = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del cliente junto con su pais y depto (los ultimos dos mediante INNER JOIN)
    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $nombres = $row["Nombres"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $apellidos = $row["Apellidos"];
        $registro = $row["Fecha_Registro"];
        $nacimiento = $row["Fecha_Nacimiento"];
        $idGenero = $row["Id_Genero"];
        $direccion = $row["Direccion"];
        $idPais = $row["Id_Pais"];
        $idDepto = $row["Id_Departamento"];
        $idCiudad = $row["Id_Ciudad"];
        $activo = $row["Activo"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de clientes, es posible llamar a estas variables en cada campo
?>