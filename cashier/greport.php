<?php
require_once '../TCPDF-main/tcpdf.php';
include '../config/constant.php';

#$pdf = New TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $date1 = new DateTime($date);
    $date1 = $date1->format('F d, Y');




    $sql = "SELECT * FROM orders WHERE date = '$date' AND status !=0";
    $res = mysqli_query($conn, $sql);

    $pdf = new TCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Virgo');
    $pdf->SetTitle('title');

    $pdf->SetFont('helvetica', 'b', 11);

    $pdf->AddPage();
    $pdf->Cell(0, 6, 'LANZ PIZZA', 0, 1, 'C');
    $pdf->Cell(0, 6, 'Sibalom, Antique', 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 13);
    $pdf->Cell(0, 10, ' DAILY SALES REPORT', 0, 1, 'C');
    $pdf->Cell(0, 8, $date1, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(10, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Trans Code', 1, 0, 'C');
    $pdf->Cell(25, 10, 'Name', 1, 0, 'C');
    $pdf->Cell(17, 10, 'Table', 1, 0, 'C');
    $pdf->Cell(16, 10, 'Type', 1, 0, 'C');
    $pdf->Cell(27, 10, 'Processed By', 1, 0, 'C');
    $pdf->Cell(17, 10, 'Amount', 1, 0, 'C');
    $pdf->Cell(17, 10, 'Cash', 1, 0, 'C');
    $pdf->Cell(17, 10, 'Change', 1, 0, 'C');
    $pdf->Cell(19, 10, 'Time', 1, 0, 'C');
    $pdf->Ln();
    $sn = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(10, 10, $sn++, 1, 0, 'C');
        $pdf->Cell(25, 10, $row['tcode'], 1, 0, 'C');
        $pdf->Cell(25, 10, $row['name'], 1, 0, 'C');
        $pdf->Cell(17, 10, $row['table'], 1, 0, 'C');
        $pdf->Cell(16, 10, $row['type'], 1, 0, 'C');
        $pdf->Cell(27, 10, $row['cashier'], 1, 0, 'C');
        $pdf->Cell(17, 10, number_format($row['total_amount'], 2), 1, 0, 'C');
        $pdf->Cell(17, 10, $row['tendered_amount'], 1, 0, 'C');
        $pdf->Cell(17, 10, $row['change_amount'], 1, 0, 'C');
        $pdf->Cell(19, 10, $row['update_time'], 1, 0, 'C');
        $pdf->Ln();
    }
    $sql2 = "SELECT SUM(total_amount)  AS sum from orders where date = '$date' and status!=0";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    $row2 = mysqli_fetch_assoc($res2);

    $total = number_format($row2['sum'], 2);

    $pdf->Cell(0, 10, 'Total Amount', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Php ' . $total, 0, 1, 'C');
}
$js = 'print(true);';
$pdf->IncludeJS($js);

$pdf->Output('report.pdf', 'I');

$pdf->AutoPrint();
header('Location: daily_reports.php');

exit();
?>
