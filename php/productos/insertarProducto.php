<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera la accion
if ($accion == "guardar") { //Si paso las validaciones tendra el valor de guardar y sino estara vacio

    $sql = "CALL Insert_Producto('" . $_POST["txtIdProducto"] . "','" . $_POST["txtNombre"] . "','" . $_POST["txtDescripcion"] .
           "','" . $_POST["cmbCategoria"] . "','" . $_POST["cmbProveedor"] . "','" . $_POST["txtCantidad"] . "','" . 
           $_POST["txtUnidad"] . "','" . $_POST["txtCantidadMax"] . "','" . $_POST["txtCantidadMin"] . "','". $_POST["txtPrecios"] . "','".$_POST["usuarioLogin"] . "')";
    //Inserta al Producto mediante el procedimiento almacenado y la conexion a la BD
    $resultado = mysqli_query($conexion, $sql);

    //echo "SQL ".$sql;
    echo "<script>alert('Registro guardado satisfactoriamente');</script>";
    //Alerta la insercion del registro
}
?>