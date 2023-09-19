<?php
require('../recursos/fpdf/fpdf.php');
//Utiliza las librerias de FPDF
$idFactura = $_GET["idFactura"];
//Recolectar el ID de la factura solicitada.
require('../php/conexion.php');
require('../php/facturas/recuperarFactura.php');


$pdf = new FPDF('P','mm',array(200, 80));
$pdf -> SetTitle('Factura No. ' . $idFactura);
$pdf -> AddPage();
 
// CABECERA
$pdf->SetFont('Helvetica','',12);
$pdf->Image('../recursos/sm-bn.png',20,0,40,35);
$pdf->Ln(20);
$pdf->Cell(60,8,'Smart Market',0,1,'C');
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(60,4,'SUPERMERCADOS SMART MARKET',0,1,'C');
$pdf->Cell(60,4,'COL. LOVELESS DISTRITO 7 SUPERMERCADO NO. 7 ',0,1,'C');
$pdf->Cell(60,4,'FRANCISCO MORAZAN, DISTRITO CENTRAL, HONDURAS',0,1,'C');
$pdf->Cell(60,4,'R.T.N. 08019994231345',0,1,'C');
$pdf->Cell(60,4,'relegal@smartmarket.hn',0,1,'C');
$pdf->Cell(60,4,'504 2353-2456',0,1,'C');
 
// DATOS FACTURA        
$pdf->Ln(5);
$pdf->SetFont('Helvetica','B',8);
$pdf->Cell(60,5,'FACTURA CONTADO',1,1,'C');
$pdf->Ln(5);
$pdf->SetFont('Helvetica','',7);
$pdf->Cell(60,4,'ID #: ' . $id . '                                            
POS #: 1',0,1,'');
$pdf->Cell(60,4,'Fecha: ' . date('d-m-Y', strtotime($fecha)) . '                          
Hora: ' . date('h:i a', strtotime($hora)),0,1,'');
$pdf->Cell(60,4,'Cajero: ' . $idUsuario . '     ' . utf8_decode($nombreEmpleado),0,1,'');
$pdf->Cell(60,4,'Documento Fiscal #:               37835799-5235dfs-224',0,1,'');
$pdf->Cell(60,4,'CAI:JI1-4AE-WSF-424-2R2-WR4',0,1,'');
$pdf->Cell(60,4,'FECHA LIMITE EMISION:                         30-04-2021',0,1,'');
$pdf->Cell(60,4,'DESDE: 1                              HASTA 1000020003000',0,1,'');
$pdf->Cell(60,4,utf8_decode('RTN: CF') ,0,1,'');
$pdf->Cell(60,4,$idCliente . "  -   " . $nombreCliente,0,1,'');
$pdf->Cell(60,4,utf8_decode('Método de Pago: ' . $metodoPago) ,0,1,'');



// COLUMNAS
$pdf->SetFont('Helvetica', 'B', 7);
$pdf->Cell(30, 10, 'Articulo', 0);
$pdf->Cell(5, 10, 'Ud',0,0,'R');
$pdf->Cell(10, 10, 'Precio',0,0,'R');
$pdf->Cell(15, 10, 'Total',0,0,'R');
$pdf->Ln(7);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);
 
// PRODUCTOS
$pdf->SetFont('Helvetica', '', 7);
$sql = "SELECT * FROM v_Detalles_Facturados WHERE Id_Factura = '" . $id . "';"; 
$result = mysqli_query($conexion, $sql); 
while ($row = mysqli_fetch_assoc($result)) { 
    $pdf->MultiCell(30,4, utf8_decode($row["Id_Producto"] . '  ' . $row["Nombre_Producto"]),0,'L'); 
    $pdf->Cell(35, -5, $row["Cantidad_Unidades"],0,0,'R');
    $pdf->Cell(10, -5, 'L. ' . number_format($row["Precio"], 2),0,0,'R');
    $pdf->Cell(15, -5, 'L. ' . number_format($row["Monto"], 2),0,0,'R');
    $pdf->Ln(0);
}


$sql = "SELECT CalcularDescuentos(" . $id . ") AS Descuentos;"; 
$result = mysqli_query($conexion, $sql); 
while ($row = mysqli_fetch_assoc($result)) { 
    $descuentos = $row["Descuentos"];
}

$sql = "SELECT CalcularImpuestos(" . $id . ") AS Impuestos;"; 
$result = mysqli_query($conexion, $sql); 
while ($row = mysqli_fetch_assoc($result)) { 
    $impuestos = $row["Impuestos"];
}

// SUMATORIO DE LOS PRODUCTOS Y EL IVA
$pdf->Ln(1);
$pdf->Cell(60,0,'','T');
$pdf->Ln(2);
$pdf->Cell(30);
$pdf->Cell(0,10, 'Subtotal', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(0, 10, 'L. ' . number_format($subtotal, 2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(30);    
$pdf->Cell(0, 10, 'Descuentos', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(0, 10, 'L. ' . number_format($descuentos, 2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(30);
$pdf->Cell(0, 10, 'Impuestos', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(0, 10, 'L. ' . number_format($impuestos, 2),0,0,'R');
$pdf->Ln(4);
$pdf->Cell(30);
$pdf->Cell(0, 10, 'Total', 0);    
$pdf->Cell(20, 10, '', 0);
$pdf->Cell(0, 10, 'L. ' . number_format($total, 2),0,0,'R');

 
// PIE DE PAGINA
$pdf->Ln(13);
$pdf->Cell(60,0,'','T');
$pdf->Ln(5);
$pdf->Cell(60,0,'Original Cliente',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,'Copia: Obligado Tributario Emisor',0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,utf8_decode('Consultas a (+504) 2233-1242 o al correo electrónico'),0,1,'C');
$pdf->Ln(3);
$pdf->Cell(60,0,utf8_decode('consultas@smartmarket.hn'),0,1,'C');
 
$pdf->Output('factura.pdf','i');
?>