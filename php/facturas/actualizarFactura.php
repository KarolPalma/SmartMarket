<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "facturar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a guardar, sino estara vacia
    echo "<script>alert('Será redireccionado al PDF de la factura');</script>";
    echo "<script>window.open('../../reporteria/facturaPDF.php?idFactura= ". $_POST["txtNoFactura"] ."', '_blank');</script>";
    //Abre el pdf en una nueva pestaña y recarga la pagina actual
} 

if ($accion == "anular") { //Si el boton presionado fue el de desactivacion la accion sera desactivar

    $sql = "CALL Anular_Factura('" . $_POST["txtNoFactura"] . "','" . $_POST["usuarioLogin"] . "')";
    //Y se anulara la factura mediante el procedimiento almacenado y la conexion
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Factura anulada satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/facturas/form_filtroFactura.php';
      </script>";
      //Para alertar la desactivacion satisfactoria y redireccionar al buscador
}
?>