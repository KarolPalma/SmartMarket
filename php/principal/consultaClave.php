<?php 
    include("../conexion.php");
    //Llamada por el login, sirve para corroborar que exista ese usuario y clave en un registro de la BD y que este activo
    $c = 0;
    $sql="SELECT COUNT(*) AS c FROM Usuarios WHERE Id_Usuario = '".$_POST["empleado_usuario"]."' AND Clave = '".$_POST["empleado_clave"]."' AND Activo = 1";

    $result=mysqli_query($conexion,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
        $c=$row["c"];
    }
    echo $c; //Si existe el conteo sera 1 y si no 0
?>