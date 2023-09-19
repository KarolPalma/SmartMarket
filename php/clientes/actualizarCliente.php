<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "guardar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a guardar, sino estara vacia

    $sql = "CALL Update_Cliente('" . $_POST["txtIdentidad"] . "','" . $_POST["txtNombres"] . "','" . $_POST["txtApellidos"] .
           "','" . $_POST["dtefnac"] . "','" . $_POST["cmbGenero"] . "','" . $_POST["txtDireccion"] . "','" . 
           $_POST["cmbCiudad"] . "','" . $_POST["arrayTelefonos"] . "','" . $_POST["arrayCorreos"] . "','" . 
           $_POST["usuarioLogin"] . "')";
    //Llama al procedimiento almacenado y le pasa todos los valores requeridos
    //Actualiza al Cliente usando la conexion.php (que debe incluirse en el form junto con este php) y el query
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro actualizado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/clientes/form_filtroCliente.php';
      </script>";
      //Proporciona un alert informativo y redirecciona al filtro de clientes o buscador
} 

if ($accion == "desactivar") { //Si el boton presionado fue el de desactivacion la accion sera desactivar

    $sql = "CALL Deactivate_Cliente('" . $_POST["txtIdentidad"] . "','" . $_POST["usuarioLogin"] . "')";
    //Y se desactivara al Cliente mediante el procedimiento almacenado y la conexion
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro desactivado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/clientes/form_filtroCliente.php';
      </script>";
      //Para alertar la desactivacion satisfactoria y redireccionar al buscador
}
?>