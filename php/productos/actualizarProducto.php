<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "guardar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a guardar, sino estara vacia

    $sql = "CALL Update_Producto('" . $_POST["txtIdProducto"] . "','" . $_POST["txtNombre"] . "','" . $_POST["txtDescripcion"] .
           "','" . $_POST["cmbCategoria"] . "','" . $_POST["cmbProveedor"] . "','" . $_POST["txtCantidad"] . "','" . 
           $_POST["txtUnidad"] . "','" . $_POST["txtCantidadMax"] . "','" . $_POST["txtCantidadMin"] . "','". $_POST["txtPrecios"] . "','".$_POST["usuarioLogin"] . "')";
    //Llama al procedimiento almacenado y le pasa todos los valores requeridos
    //Actualiza al Producto usando la conexion.php (que debe incluirse en el form junto con este php) y el query
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro actualizado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/productos/form_filtroProducto.php';
      </script>";
      //Proporciona un alert informativo y redirecciona al filtro de productos o buscador
} 

if ($accion == "desactivar") { //Si el boton presionado fue el de desactivacion la accion sera desactivar

    $sql = "CALL Deactivate_Producto('" . $_POST["txtIdProducto"] . "','" . $_POST["usuarioLogin"] . "')";
    //Y se desactivara al Producto mediante el procedimiento almacenado y la conexion
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro desactivado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/productos/form_filtroProducto.php';
      </script>";
      //Para alertar la desactivacion satisfactoria y redireccionar al buscador
}

if ($accion == "generar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a generar, sino estara vacia
    echo "<script>var numero = prompt('Ingrese la cantidad de producto a solicitar', '');</script>";
    echo "<script>if(numero === null){}else{alert('Será redireccionado al PDF del pedido de este producto');";
    echo "window.open('../../reporteria/pedidoPDF.php?numero='+ numero +'&idProducto=". $_POST["txtIdProducto"] ."', '_blank')};</script>";
} 
?>