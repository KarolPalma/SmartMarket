<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera la accion
$apertura = isset($_POST["apertura"]) ? $_POST["apertura"] : ""; //Recupera si la factura ya fue abierta o no
if ($accion == "insertarDetalle" && $apertura == '') { //Si paso las validaciones tendra el valor de guardar y sino estara vacio

    $sql = "CALL Open_Factura('" . $_POST["usuarioLogin"] . "')";
           
    $resultado = mysqli_query($conexion, $sql);

    $sql = "CALL Insert_Detalle_Factura('" . $_POST["txtNoFactura"] . "','" . $_POST["cmbProducto"] . "','" . $_POST["txtCantidad"] .
           "','" . $_POST["cmbDescuento"] . "','" . $_POST["cmbImpuesto"] . "')";
           
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro guardado satisfactoriamente');</script>";
    echo "<script>document.getElementById('apertura').value = 'apertura';</script>";
    echo "<script>document.getElementById('accion').value = '';</script>";
    echo "<script>document.getElementById('formulario').submit() = '';</script>";
    //Utiliza el campo apertura para validar que no este abierta ya, y asi seguir insertando productos
} else if($accion == "insertarDetalle") {
    $sql = "CALL Insert_Detalle_Factura('" . $_POST["txtNoFactura"] . "','" . $_POST["cmbProducto"] . "','" . $_POST["txtCantidad"] .
    "','" . $_POST["cmbDescuento"] . "','" . $_POST["cmbImpuesto"] . "')";
    //Si la accion es de insercion de detalle llama al SP correspondiente
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro guardado satisfactoriamente');</script>";
    echo "<script>document.getElementById('accion').value = '';</script>";
}
?>
