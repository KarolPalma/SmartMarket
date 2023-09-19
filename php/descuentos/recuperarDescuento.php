<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del Descuento seleccionado desde la base de datos
    $id = $_GET['idDescuento']; //Recupera el ID del Descuento que fue enviada por metodo GET desde el filtro de Descuento

    //Inicializacion de variables
    $nombre = '';
    $valor = '';


    $sql = "SELECT * FROM v_Descuento WHERE Id_Descuento = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del descuento junto con precio (mediante INNER JOIN)

    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $nombre = $row["Nombre_Descuento"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $valor = $row["Valor_Descuento"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de escuentos, es posible llamar a estas variables en cada campo

?>

