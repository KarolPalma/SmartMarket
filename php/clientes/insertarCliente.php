<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera la accion
if ($accion == "guardar") { //Si paso las validaciones tendra el valor de guardar y sino estara vacio

    $sql = "CALL Insert_Cliente('" . $_POST["txtIdentidad"] . "','" . $_POST["txtNombres"] . "','" . $_POST["txtApellidos"] .
           "','" . $_POST["dtefnac"] . "','" . $_POST["cmbGenero"] . "','" . $_POST["txtDireccion"] . "','" . 
           $_POST["cmbCiudad"] . "','" . $_POST["arrayTelefonos"] . "','" . $_POST["arrayCorreos"] . "','" . 
           $_POST["usuarioLogin"] . "')";
    //Inserta al Cliente mediante el procedimiento almacenado y la conexion a la BD
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro guardado satisfactoriamente');</script>";
    //Alerta la insercion del registro
}
?>