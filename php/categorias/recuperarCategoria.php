<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del registro seleccionado desde la base de datos
    $id = $_GET['idCategoria']; //Recupera el id del registro que fue enviada por metodo GET desde el filtro de la bitacora

    //Inicializacion de variables
    $categoria = '';
    $descripcion = '';
    $activo = '';
    if($id != 0){
        $sql = "SELECT * FROM Categorias WHERE Id_Categoria = '" . $id . "';";
        $result = mysqli_query($conexion, $sql); //Efectua la consulta
        while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
            $categoria = $row["Categoria"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
            $descripcion = $row["Descripcion"];
            $activo = $row["Activo"];
        }
    }else{
        echo "<script>window.location.href = 'form_filtroCategoria.php'</script>";
    }
?>