<?php 
    //Consulta PHP para la revision de ID del impuesto llamada por AJAX en la funcion revisarIdImpuesto() en impuestos.js
    include("../conexion.php");
    //Se incluye la conexion a la BD
    $idImpuesto = $_POST["id_impuesto"]; //Se recupera el campo de idImpuesto enviado mediante AJAX
    $c = 0; //Variable de conteo
    $sql = "SELECT COUNT(*) AS c FROM Impuestos WHERE Id_Impuesto = '$idImpuesto'"; //Solicita un conteo de los registros que posean un numero de idImpuesto igual al del campo en la tabla de Impuestos

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c; //Devuelve c como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es 0 o 1
?>