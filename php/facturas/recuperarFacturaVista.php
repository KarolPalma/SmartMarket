<?php 
    //Este php solo es usado en actualizaciones para recuperar los datos del registro seleccionado desde la base de datos
    $id = $_GET['idFactura']; 

    //Inicializacion de variables
    $fecha = '';
    $hora = '';
    $idCliente = '';
    $idUsuario = '';
    $metodoPago = '';
    $subtotal = '';
    $total = '';

    $estadoFactura = '';
    $fechaAnulacion = '';
    $horaAnulacion = '';
    $anulador = '';

    $sql = "SELECT * FROM v_Facturas WHERE Id_Factura = '" . $id . "';"; 
    $result = mysqli_query($conexion, $sql); 
    while ($row = mysqli_fetch_assoc($result)) { 
        $fecha = $row["Fecha_Factura"]; 
        $hora = $row["Hora_Factura"];
        $idCliente = $row["Id_Cliente"];
        $idUsuario = $row["Id_Usuario"];
        $metodoPago = $row["Id_Metodo_Pago"];
        $subtotal = $row["SubTotal"];
        $total = $row["Total"];
        if($row["Fecha_Anulacion"] == ''){
            $estadoFactura = '0';
        }else{
            $estadoFactura = '1';
        }
        $fechaAnulacion = $row["Fecha_Anulacion"];
        $horaAnulacion = $row["Hora_Anulacion"];
        $anulador = $row["Anulador"];
    }
    //Con esto y al incluir este archivo php al form de actualizacion de facturas, es posible llamar a estas variables en cada campo
?>