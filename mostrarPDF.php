<?php
$id = $_POST['idTurno1'];
require('fpdf/fpdf.php');
require("clases/db.php");
$link = mysqli_connect("localhost", "root", "", "est");
$fpdf = new FPDF('P', 'mm', 'letter', true);
$fpdf->AddPage('portrait', 'letter');
$fpdf->SetMargins(10, 30, 20, 20);
cabecera($fpdf, $link,$id);
piedepagina($fpdf);

titulosdetalle($fpdf);
imprimirdetalle($fpdf, $link, $id);

$fpdf->OutPut();


function cabecera($fpdf, $link, $id)
{
    $fpdf->SetFillColor(116, 92, 151);
    $fpdf->Rect(0, 0, 220, 50, 'F');
    $fpdf->SetFont('Arial', 'B', 15);
    $fpdf->SetTextColor(255, 255, 255);
    $fpdf->Image('img/logo.png', 10, 1);
    $datos = mysqli_query($link, "select date_format(now(),'%d/%m/%Y') as fecha from reserva where idReserva='$id'");
    $resultado = mysqli_fetch_array($datos);
    $fpdf->SetFont('Arial', 'B', 10);
    $fpdf->SetY(5);
    $fpdf->SetX(100);
    $fpdf->Cell(0, 5, utf8_decode("Fecha de emisión : ") .$resultado['fecha'], 0, 0, 'L', 1);
}

function piedepagina($fpdf)
{
    $fpdf->SetFillColor(116, 92, 151);
    $fpdf->Rect(0, 250, 220, 50, 'F');
    $fpdf->SetY(-28);
    $fpdf->SetFont('Arial', '', 12);
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->SetX(120);
    $fpdf->Write(5, 'Gracias por elegirnos.');
}

function titulosdetalle($fpdf)
{
    $fpdf->SetY(60);
    $fpdf->SetTextColor(255, 255, 255);
    $fpdf->SetFillColor(79, 78, 77);
    $fpdf->Cell(60, 10, 'Desde', 0, 0, 'C', 1);
    $fpdf->Cell(60, 10, 'Hasta', 0, 0, 'C', 1);
    $fpdf->Cell(20, 10, 'Costo', 0, 0, 'R', 1);
    $fpdf->Cell(25, 10, 'Lugar', 0, 0, 'L', 1);
    $fpdf->Cell(25, 10, 'Patente', 0, 0, 'L', 1);
}

function imprimirdetalle($fpdf, $link,$id)
{
    $datos = mysqli_query($link, "SELECT * FROM reserva, caja, vehiculo, usuario, lugar WHERE Caja_idCaja = idCaja AND idReserva = '$id' AND Lugar_idLugar = idLugar AND Vehiculo_idVehiculo = idVehiculo AND Usuario_idUsuario = idUsuario ");
    $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->SetFillColor(255, 255, 255);
    $fpdf->SetFont('times', '', 12);
    $fpdf->SetY(70);
    $fpdf->SetLineWidth(0.2);
    $pago=0;
    $item=0;
    foreach ($resultado as $fila) {
        $fpdf->Cell(60, 10, utf8_encode( date('d-m-Y H:i:00', strtotime($fila['Desde']))), 1, 0, 'C', 1);
        $fpdf->Cell(60, 10, utf8_encode( date('d-m-Y H:i:00', strtotime($fila['Hasta']))), 1, 0, 'C', 1);
        $fpdf->Cell(20, 10, '$'.number_format($fila['Costo'],2,',','.'), 1, 0, 'R', 1);
        $fpdf->Cell(25, 10, $fila['Lugar'], 1, 0, 'R', 1);
        $fpdf->Cell(25, 10, $fila['patente'], 1, 0, 'R', 1);
        $fpdf->Ln();
        $pago=$fila['Costo'];
        $item++;
        if ($item==16) {
            $fpdf->AddPage('portrait', 'letter');
            $fpdf->SetMargins(10, 30, 20, 20);
            cabecera($fpdf, $conexion);
            piedepagina($fpdf);            
            titulosdetalle($fpdf);
            $fpdf->SetTextColor(0, 0, 0);
            $fpdf->SetFillColor(255, 255, 255);
            $fpdf->SetFont('Arial', '', 12);
            $fpdf->SetY(70);
            $fpdf->SetLineWidth(0.2);        
            $item=0;
        }
    }
    $fpdf->SetFont('Arial', 'B', 15);
    $fpdf->Cell(190, 20, "Importe Total : $".number_format($pago,2,',','.'), 1, 0, 'R', 1);
}