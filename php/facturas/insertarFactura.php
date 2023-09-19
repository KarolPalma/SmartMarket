<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : "";
if ($accion == "guardar") {

    $sql = "CALL Close_Factura('" . $_POST["txtNoFactura"] . "','" . $_POST["txtCliente"] . "','" . $_POST["usuarioLogin"] .
           "','" . $_POST["cmbMetodoPago"] . "')";

    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Venta registrada satisfactoriamente, será redireccionado al PDF de la factura');</script>";
    echo "<script>window.open('../../reporteria/facturaPDF.php?idFactura= ". $_POST["txtNoFactura"] ."', '_blank');</script>";
    echo "<script>window.history.replaceState({}, document.title, '/' + 'smart_market/forms/facturas/form_insertarFactura.php');
                  location.reload();</script>";
    //Notifica el resultado satisfactorio, abre el pdf en otra pestaña y recarga la pestaña actual de insercion de factura
} else if ($accion == "prefacturar") {
    echo "<script>alert('Será redireccionado al PDF de la prefactura');</script>";
    echo "<script>window.open('../../reporteria/prefacturaPDF.php?idFactura= ". $_POST["txtNoFactura"] ."', '_blank');</script>";
    //Abre la prefactura en otra pestaña
}
?>