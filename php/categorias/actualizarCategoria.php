<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "guardar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a guardar, sino estara vacia

    $sql = "CALL Update_Categoria('" . $_POST["txtNoCategoria"] . "','" . $_POST["txtCategoria"] . "','" . 
            $_POST["txtDescripcion"] . "','" . $_POST["usuarioLogin"] . "')";
    //Usa el procedimiento almacenado en la bd para la actualizacion de la categoria
    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro actualizado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/categorias/form_filtroCategoria.php';
      </script>";
} 

if ($accion == "desactivar") { //Si el boton presionado fue el de desactivacion la accion sera desactivar

    $sql = "CALL Deactivate_Categoria('" . $_POST["txtNoCategoria"] . "','" . $_POST["usuarioLogin"] . "')";

    $resultado = mysqli_query($conexion, $sql);
    echo "<script>alert('Registro desactivado satisfactoriamente');</script>";
    echo "<script>
                window.location.href = '../../forms/categorias/form_filtroCategoria.php';
      </script>";
      //Para alertar la desactivacion satisfactoria y redireccionar al buscador
}
?>