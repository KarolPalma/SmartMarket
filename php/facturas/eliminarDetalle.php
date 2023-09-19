<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera la accion

if ($accion == "eliminarDetalle") { //Si paso las validaciones tendra el valor de eliminar y sino estara vacio

    $sql = "CALL Delete_Detalle_Factura('" . $_POST["facturaDetalle"] . "','" . $_POST["detalleEliminar"] . "','" . $_POST["usuarioElimina"] . "')";
    //Llama al procedimiento almacenado para la eliminacion del detalle
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Producto eliminado de la factura satisfactoriamente');</script>";
}
?>
