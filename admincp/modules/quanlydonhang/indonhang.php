<?php
require('../../../tfpdf/tfpdf.php');
require('../../config/config.php');

$pdf = new tFPDF();
$pdf->AddPage("P", "A4", 0);
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',14);
$pdf->SetFillColor(193,229,252);

$code = $_GET['code'];
$sql_lietke_dh = "SELECT * FROM tbl_cart_details 
                  INNER JOIN tbl_sanpham ON tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
                  WHERE tbl_cart_details.code_cart = '".$code."' 
                  ORDER BY tbl_cart_details.id_cart_details DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);

$pdf->Cell(0, 10, 'ĐƠN HÀNG CỦA BẠN', 0, 1, 'C');
$pdf->Ln(5);
$pdf->Write(10, 'Danh sách sản phẩm trong đơn hàng:');
$pdf->Ln(10);

// Định nghĩa độ rộng cột
$width_cell = array(10, 35, 75, 20, 25, 35);

$pdf->SetFont('DejaVu','',12);
$pdf->Cell($width_cell[0],10,'#',1,0,'C',true);
$pdf->Cell($width_cell[1],10,'Mã hàng',1,0,'C',true);
$pdf->Cell($width_cell[2],10,'Tên sản phẩm',1,0,'C',true);
$pdf->Cell($width_cell[3],10,'SL',1,0,'C',true); 
$pdf->Cell($width_cell[4],10,'Đơn giá',1,0,'C',true);
$pdf->Cell($width_cell[5],10,'Thành tiền',1,1,'C',true);

$pdf->SetFillColor(235,236,236); 
$fill = false;
$tongtien = 0;
$i = 0;

while($row = mysqli_fetch_array($query_lietke_dh)){
    $i++;
    $thanhtien = $row['soluongmua'] * $row['giasp'];
    $tongtien += $thanhtien;

    $pdf->Cell($width_cell[0],10,$i,1,0,'C',$fill);
    $pdf->Cell($width_cell[1],10,$row['code_cart'],1,0,'C',$fill);
    $pdf->Cell($width_cell[2],10,$row['tensanpham'],1,0,'L',$fill);
    $pdf->Cell($width_cell[3],10,$row['soluongmua'],1,0,'C',$fill);
    $pdf->Cell($width_cell[4],10,number_format($row['giasp'],0,',','.').'đ',1,0,'R',$fill);
    $pdf->Cell($width_cell[5],10,number_format($thanhtien,0,',','.').'đ',1,1,'R',$fill);
    $fill = !$fill;
}

// Tổng tiền
$pdf->SetFont('DejaVu','',13);
$pdf->Cell(array_sum($width_cell) - $width_cell[5], 10, 'Tổng cộng:', 1, 0, 'R', true);
$pdf->Cell($width_cell[5], 10, number_format($tongtien,0,',','.').'đ', 1, 1, 'R', true);

$pdf->Ln(10);
$pdf->SetFont('DejaVu','',12);
$pdf->Write(10,'Cảm ơn bạn đã đặt hàng tại website của chúng tôi!');
$pdf->Ln(5);
$pdf->Output();
?>
