<?php 
    //Consulta PHP para la revision de ID del productollamada por AJAX en la funcion revisarIdProducto() en productos.js
    include("../conexion.php");
    //Se incluye la conexion a la BD
    $idProducto = $_POST["id_producto"]; //Se recupera el campo de idProducto enviado mediante AJAX
    $c = 0; //Variable de conteo
    $sql = "SELECT COUNT(*) AS c FROM Productos WHERE Id_Producto = '$idProducto'"; //Solicita un conteo de los registros que posean un numero de idProducto igual al del campo en la tabla de Productos

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c; //Devuelve c como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es 0 o 1
?>