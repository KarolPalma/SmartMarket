<?php
require('../recursos/fpdf/fpdf.php');
//Librerias de FPDF
require('../php/conexion.php');


$pdf = new FPDF('L', 'mm', 'legal');
$pdf->SetTitle('Inventario Total - Smart Market');
$pdf->AddPage();

// Encabezado
$pdf->SetFont('Arial', 'B', 14);
$pdf->Image('../recursos/sm.png', 12, 10, 15);

$pdf->Cell(30);
$pdf->Cell(40, 10, 'Inventario de Productos Smart Market');


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(1, 1, 1);
$pdf->Cell(195);
$pdf->Cell(40, 10, 'Fecha: ' . date('d-m-Y'));
$pdf->Cell(40, 10, 'Hora: ' .  date('H:i:s', time() - 3600));

//Listado de Productos
$pdf->Ln(20);
$pdf->Cell(3);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Listado de Productos');
$pdf->Ln(20);

$pdf->Cell(3);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, utf8_decode('Código'), 1, 0, 'C', 0);
$pdf->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(30, 10, utf8_decode('U. Almacén'), 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Precio U.', 1, 0, 'C', 0);
$pdf->Cell(60, 10, 'Proveedor', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Cantidad U.', 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode('U. Mín.'), 1, 0, 'C', 0);
$pdf->Cell(20, 10, utf8_decode('U. Máx.'), 1, 0, 'C', 0);
$pdf->Cell(35, 10, utf8_decode('Categoría'), 1, 0, 'C', 0);
$pdf->Cell(35, 10, 'Estado', 1, 1, 'C', 0);

$consulta = "SELECT * FROM v_Inventario";
$resultado = mysqli_query($conexion, $consulta);

$pdf->SetFont('Arial', '', 10);
while ($row = $resultado->fetch_assoc()) {
    $estado = '';
    if ($row["Descontinuado"] == 0) {
        $estado = 'Activo';
    } else {
        $estado = 'Descontinuado';
    }
    $pdf->Cell(3);
    $pdf->Cell(20, 10, utf8_decode($row["Id_Producto"]), 1, 0, 'C', 0);
    $pdf->Cell(50, 10, utf8_decode($row["Nombre_Producto"]), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($row["Unidades_Almacen"]), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode('L. ' .$row["Precio"]), 1, 0, 'C', 0);
    $pdf->Cell(60, 10, utf8_decode($row["Nombre_Proveedor"]), 1, 0, 'C', 0);
    $pdf->Cell(30, 10, utf8_decode($row["Cantidad_Unidad"]), 1, 0, 'C', 0);
    $pdf->Cell(20, 10, utf8_decode($row["Cantidad_Minima"]), 1, 0, 'C', 0);
    $pdf->Cell(20, 10, utf8_decode($row["Cantidad_Maxima"]), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($row["Categoria"]), 1, 0, 'C', 0);
    $pdf->Cell(35, 10, utf8_decode($estado), 1, 1, 'C', 0);
}

//Pie de pagina
$x = $pdf->GetX();
$y = $pdf->GetY();
$y = $y + 10;
$pdf->SetXY($x + 3, $y);
$pdf -> Cell(40,10,utf8_decode('Listado de Productos a la fecha y hora especificados en el encabezado.                                                                                                                                                                                                     
Smart Market'));


$pdf->Output('inventario-sm.pdf', 'i');
?>