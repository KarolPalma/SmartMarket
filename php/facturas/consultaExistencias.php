<?php 
    //Consulta PHP para la revision de cantidad de producto llamada por AJAX en la funcion en productos.js
    include("../conexion.php");
    //Se incluye la conexion a la BD
    $producto = $_POST["producto"];
    $cantidad = $_POST["cantidad"]; 
    $c = 0; //Variable de conteo
    $sql = "SELECT Unidades_Almacen AS c FROM Productos WHERE Id_producto = '$producto'"; //Solicita un conteo de los registros que correspondan a la consulta

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c - $cantidad; //Devuelve la resta como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es mayor o igual a 0
?>