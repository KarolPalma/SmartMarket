<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del impuesto seleccionado desde la base de datos
    $id = $_GET['idImpuesto']; //Recupera el ID del impuesto que fue enviada por metodo GET desde el filtro de impuesto

    //Inicializacion de variables
    $nombre = '';
    $valor = '';


    $sql = "SELECT * FROM v_Impuesto WHERE Id_Impuesto = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del impuesto junto con precio (mediante INNER JOIN)

    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $nombre = $row["Nombre_Impuesto"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $valor = $row["Valor_Impuesto"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de impuestos, es posible llamar a estas variables en cada campo

?>

