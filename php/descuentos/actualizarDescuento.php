<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "guardar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a guardar, sino estara vacia

    $sql = "CALL Update_Descuento('" . $_POST["txtIdDescuento"] . "','" . $_POST["txtNombre"] . "',
    '" . $_POST["txtValor"] ."','".$_POST["usuarioLogin"] . "')";
    //Llama al procedimiento almacenado y le pasa todos los valores requeridos
    //Actualiza al Descuento usando la conexion.php (que debe incluirse en el form junto con este php) y el query
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro actualizado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/descuentos/form_filtroDescuento.php';
      </script>";
      //Proporciona un alert informativo y redirecciona al filtro de descuentos o buscador
} 

if ($accion == "desactivar") { //Si el boton presionado fue el de desactivacion la accion sera desactivar

    $sql = "CALL Deactivate_Descuento('" . $_POST["txtIdDescuento"] . "','" . $_POST["usuarioLogin"] . "')";
    //Y se desactivara al Descuento mediante el procedimiento almacenado y la conexion
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro desactivado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/descuentos/form_filtroDescuento.php';
      </script>";
      //Para alertar la desactivacion satisfactoria y redireccionar al buscador
}
?>