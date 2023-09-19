<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del producto seleccionado desde la base de datos
    $id = $_GET['idProducto']; //Recupera el ID del producto que fue enviada por metodo GET desde el filtro de producto

    //Inicializacion de variables
    $nombre = '';
    $descripcion = '';
    $idCategoria = '';
    $idProveedor = '';
    $cantidad = '';
    $unidad = '';
    $cantidadMax = '';
    $cantidadMin = '';
    $precio = '';
    $descontinuado = '';

    $sql = "SELECT * FROM v_Producto WHERE Id_Producto = '" . $id . "';"; //Utiliza una vista en la BD creada para devolver los datos del producto junto con precio (mediante INNER JOIN)

    $result = mysqli_query($conexion, $sql); //Efectua la consulta
    while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
        $nombre = $row["Nombre_Producto"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
        $descripcion = $row["Descripcion"];
        $idCategoria = $row["Id_Categoria"];
        $idProveedor = $row["Id_Proveedor"];
        $cantidad = $row["Cantidad_Unidad"];
        $unidad = $row["Unidades_Almacen"];
        $cantidadMax = $row["Cantidad_Maxima"];
        $cantidadMin = $row["Cantidad_Minima"];
        $precio = $row["Precio"];
        $descontinuado = $row["Descontinuado"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de productos, es posible llamar a estas variables en cada campo

?>

