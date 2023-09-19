<?php
$accion = isset($_POST["accion"]) ? $_POST["accion"] : ""; //Recupera el campo oculto de accion
if ($accion == "generar") { //Si el form a pasado correctamente por las validaciones la accion se habra cambiado a generar, sino estara vacia
    echo "<script>alert('Será redireccionado al PDF del reporte de Inventario Total');</script>";
    echo "<script>window.open('../../reporteria/inventarioPDF.php', '_blank');</script>";
} 
?>