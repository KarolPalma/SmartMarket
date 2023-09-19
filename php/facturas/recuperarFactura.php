<?php 
    $id = $_GET['idFactura'];

    //Inicializacion de variables
    $fecha = '';
    $hora = '';
    $idCliente = '';
    $nombreCliente = '';
    $idUsuario = '';
    $nombreEmpleado = '';
    $metodoPago = '';
    $subtotal = '';
    $total = '';

    $sql = "SELECT * FROM v_Encabezado_Factura WHERE Id_Factura = '" . $id . "';"; 
    $result = mysqli_query($conexion, $sql); 
    while ($row = mysqli_fetch_assoc($result)) { 
        $fecha = $row["Fecha_Factura"]; 
        $hora = $row["Hora_Factura"];
        $idCliente = $row["Id_Cliente"];
        $nombreCliente = $row["Nombre_Cliente"];
        $idUsuario = $row["Id_Usuario"];
        $nombreEmpleado = $row["Nombre_Empleado"];
        $metodoPago = $row["Metodo_Pago"];
        $subtotal = $row["SubTotal"];
        $total = $row["Total"];
    }
    //Con esto y al incluir este archivo php al pdf de facturas, es posible llamar a estas variables en cada campo e imprimirlas
?>