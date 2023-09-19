<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera la accion
if ($accion == "guardar") { //Si paso las validaciones tendra el valor de guardar y sino estara vacio

    $sql = "CALL Insert_Categoria('" . $_POST["txtCategoria"] . "','" . $_POST["txtDescripcion"] . "','" . $_POST["usuarioLogin"] . "')";
    //Inserta la categoria mediante el procedimiento almacenado y la conexion a la BD
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro guardado satisfactoriamente');</script>";
    //Alerta la insercion del registro
}
?>