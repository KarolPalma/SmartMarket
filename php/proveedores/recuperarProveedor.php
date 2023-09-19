<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del proveedor seleccionado desde la base de datos
    $id = $_GET['idProveedor']; //Recupera el id del proveedor que fue enviada por metodo GET desde el filtro de proveedor

    //Inicializacion de variables
    $nombre = '';
    $contacto = '';
    $direccion = '';
    $idPais = '';
    $idDepto = '';
    $idCiudad = '';
    $activo = '';

    $sql = "SELECT * FROM v_Proveedor WHERE Id_Proveedor = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del cliente junto con su pais y depto (los ultimos dos mediante INNER JOIN)
    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $nombre = $row["Nombre_Proveedor"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $contacto = $row["Contacto"];
        $direccion = $row["Direccion"];
        $idPais = $row["Id_Pais"];
        $idDepto = $row["Id_Departamento"];
        $idCiudad = $row["Id_Ciudad"];
        $activo = $row["Activo"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de proveedores, es posible llamar a estas variables en cada campo
?>