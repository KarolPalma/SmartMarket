<?php 
    include("../conexion.php");
    $usuario = $_POST["usuario"];
    $clave = $_POST["clave"]; 
    $c = 0; 
    $sql = "SELECT COUNT(*) AS c FROM Usuarios WHERE Id_Usuario = '$usuario' AND Clave = '$clave' AND Administrador = 1"; //Solicita un conteo de los registros que posean un numero de identidad igual al del campo en la tabla de Clientes

    $result = mysqli_query($conexion,$sql); //Ejecuta el query
    while($row=mysqli_fetch_assoc($result)) //Recorre la respuesta por cada registro
    {
        $c = $row["c"]; //Si no hay registros c=0 pero si hay (el caso maximo es que haya un registro) c=1
    }
    echo $c; //Devuelve c como una respuesta HTML que es recojida por AJAX que determinara que hacer si el valor es 0 o 1
?>