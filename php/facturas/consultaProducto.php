<?php 
    //Consulta PHP para la revision de productos en los detalles de la factura llamada por AJAX en la funcion de productos.js
    include("../conexion.php");
    //Se incluye la conexion a la BD
    $producto = $_POST["producto"];
    $noFactura = $_POST["noFactura"]; 
    $c = 0; //Variable de conteo
    $sql = "SELECT COUNT(*) AS c FROM Detalles_Facturas WHERE Id_Factura = '$noFactura' AND Id_Producto = '$producto'"; //Solicita un conteo de los registros que posean un ese id de producto en esa factura

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c; //Devuelve c como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es 0 o 1
?>