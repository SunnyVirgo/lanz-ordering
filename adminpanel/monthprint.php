<?php
require_once '../TCPDF-main/tcpdf.php';
include '../config/constant.php';

#$pdf = New TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
if (isset($_GET['month']) && isset($_GET['year'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
    $month1 = date('F', mktime(0, 0, 0, $month, 10));

    $sql = "SELECT * FROM orders WHERE MONTH(date) = '$month' and YEAR(date)='$year' AND status !=0";
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
    $pdf->Cell(0, 10, ' MONTHLY SALES REPORT', 0, 1, 'C');
    $pdf->Cell(0, 8, $month1 . ' ' . $year, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(15, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Date', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Total Orders', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Total Sales', 1, 0, 'C');
    $pdf->Ln();
    $sn = 1;

    $query = "SELECT DATE(date) as order_date, COUNT(*) as total_orders, SUM(total_amount) as total_sales FROM orders WHERE MONTH(date) = $month AND YEAR(date) = $year and status != 0 GROUP BY date";

    $result = $conn->query($query);
    $count = mysqli_num_rows($result);

    $orders = [];
    while ($row = $result->fetch_assoc()) {
        $orders[$row['order_date']] = [
            'total_orders' => $row['total_orders'],
            'total_sales' => $row['total_sales'],
        ];
    }

    foreach ($orders as $date => $order) {
        $date1 = new DateTime($date);
        $date1 = $date1->format('F d, Y');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(15, 10, $sn++, 1, 0, 'C');
        $pdf->Cell(60, 10, $date1, 1, 0, 'C');
        $pdf->Cell(60, 10, $order['total_orders'], 1, 0, 'C');
        $pdf->Cell(60, 10, number_format($order['total_sales'], 2), 1, 0, 'C');
        $pdf->Ln();
    }

    $sql2 = "SELECT SUM(total_amount)  AS sum from orders where MONTH(date)='$month' and YEAR(date)='$year' and status!=0";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    $row2 = mysqli_fetch_assoc($res2);

    $total = number_format($row2['sum'], 2);

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(0, 10, 'Total Amount: ' . 'Php ' . $total, 0, 1, 'C');
}

$pdf->Output('report1.pdf', 'I');

$pdf->AutoPrint();
header('Location: daily_reports.php');

exit();
?>
