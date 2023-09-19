<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del registro seleccionado desde la base de datos
    $id = $_GET['idRegistro']; //Recupera la identidad del registro que fue enviada por metodo GET desde el filtro de la bitacora

    //Inicializacion de variables
    $idUsuario = '';
    $fecha = '';
    $hora = '';
    $detalle = '';
    if($id != 0){
        $sql = "SELECT *, date_format(Hora,'%r') as hora FROM Bitacora WHERE Id_Registro = '" . $id . "';";
        $result = mysqli_query($conexion, $sql); //Efectua la consulta
        while ($row = mysqli_fetch_assoc($result)) { //Y recorre cada registro (que en realidad solo es un registro porque los ID son unicos)
            $idUsuario = $row["Id_Usuario"]; //Asigna los valores de la BD (segun nombre de columna) a las variables inicializadas arriba
            $fecha = $row["Fecha"];
            $hora = $row["hora"];
            $detalle = $row["Detalle"];
        }
    }else{ //Redirecciona al filtro de bitacoras si el id proporcionado no es valido
        echo "<script>window.location.href = 'form_filtroBitacora.php'</script>";
    }
?>