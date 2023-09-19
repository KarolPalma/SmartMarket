<?php
require('../recursos/fpdf/fpdf.php');
//Librerias de FPDF
require('../php/conexion.php');

$pdf = new FPDF('P', 'mm', 'letter');
$pdf->SetTitle('Solicitud de Productos - Smart Market');
$pdf->AddPage();

// Encabezado
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Image('../recursos/sm.png', 12, 20, 15);

$pdf->Cell(30);
$pdf->Cell(40, 10, 'Solicitud de Productos - Smart Market');

$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(1, 1, 1);
$pdf->Ln(10);
$pdf->Cell(150);
$pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'));
$pdf->Ln(10);
$pdf->Cell(150);
$pdf->Cell(40, 10, 'Hora: ' .  date('H:i:s', time() - 3600));

//Recuperacion de datos del producto a pedir
$idproducto = $_GET["idProducto"];
$numero = $_GET["numero"];

$nombre = '';
$proveedor = '';
$cantidadUnidad = '';
$categoria = '';

$consulta = "SELECT * FROM v_Inventario WHERE Id_Producto = '" . $idproducto . "'" ;
$resultado = mysqli_query($conexion, $consulta);

while ($row = $resultado->fetch_assoc()) {
    $nombre = $row["Nombre_Producto"];
    $proveedor = $row["Nombre_Proveedor"];
    $cantidadUnidad = $row["Cantidad_Unidad"];
    $categoria = $row["Categoria"];
}


$pdf->Ln(10);
$pdf->Cell(5);
$pdf->Cell(40, 10, 'Gerencia de Supermercado');
$pdf->Ln(8);
$pdf->Cell(5);
$pdf->Cell(40, 10, 'Smart Market');
$pdf->Ln(8);
$pdf->Cell(5);
$pdf->Cell(40, 10, 'Departamento de Ventas');
$pdf->Ln(8);
$pdf->Cell(5);
$pdf->Cell(40, 10, utf8_decode('Proveedor ' . $proveedor));

//Cuerpo
$pdf->Ln(20);
$pdf->Cell(5);
$pdf -> Cell(40,10,utf8_decode('Por medio de la presente,'));
$pdf->Ln(15);
$pdf->Cell(5);
$pdf->SetXY(15, 120);
$pdf->MultiCell(190, 6, utf8_decode('Smart Market solicita a ' . $proveedor . ' los siguientes productos asignados bajo contrato a su línea de distribución mensual con nuestro supermercado:'));
$pdf->Ln(10);

$pdf->Cell(12);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, utf8_decode('Código'), 1, 0, 'C', 0);
$pdf->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Cantidad U.', 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode('Categoría'), 1, 0, 'C', 0);
$pdf->Cell(40, 10, 'Unidades Solicitadas', 1, 1, 'C', 0);


$pdf->Cell(12);
$pdf->Cell(20, 10, utf8_decode($idproducto), 1, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, utf8_decode($nombre), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($cantidadUnidad), 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode($categoria), 1, 0, 'C', 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 10, utf8_decode($numero), 1, 1, 'C', 0);
$pdf->SetFont('Arial', '', 10);

//Pie y firmas
$pdf->Ln(15);
$pdf->Cell(5);
$pdf->SetXY(15, 170);
$pdf->MultiCell(190, 6, utf8_decode('Como es habitual, el pago del pedido será realizado mediante transferencia bancaria, una vez confirmada la entrega del pedido en nuestras instalaciones del Distrito 7, Francisco Morazán, Honduras.'));
$pdf->SetXY(15, 190);
$pdf->MultiCell(190, 6, utf8_decode('Atentamente'));
$pdf->SetXY(15, 220);
$pdf->MultiCell(190, 6, utf8_decode('Dirección Administrativa y de Ventas'));
$pdf->SetXY(15, 225);
$pdf->MultiCell(190, 6, utf8_decode('Smart Market'));

$x = $pdf->GetX();
$y = $pdf->GetY();
$y = $y + 15;
$pdf->SetXY($x + 5, $y);
$pdf -> Cell(40,10,utf8_decode('Solicitud de productos impresa a la fecha y hora especificados en el encabezado.                                    
Smart Market'));


$pdf->Output('inventario-sm.pdf', 'i');
?>