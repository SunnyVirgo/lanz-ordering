<?php
require_once '../TCPDF-main/tcpdf.php';
include '../config/constant.php';

#$pdf = New TCPDF('p', 'mm', 'A4', true, 'UTF-8', false);
if (isset($_GET['start']) && isset($_GET['end']) && isset($_GET['quarter'])) {


    $quarter = $_GET['quarter'];
    $sn=1;
    $start_date=$_GET['start'];
    $end_date=$_GET['end'];
    $year = date('Y', strtotime($start_date));
    $start = date('F d, Y', strtotime($start_date));
    $end = date('F d, Y', strtotime($end_date));
    if($quarter == 1)
    {
       $name = "First";
     
  
    }
    elseif ($quarter == 2) 
    {
        $name = "Second";
    }
    elseif ($quarter == 3) 
    {
        $name = "Third";
    }
    else
    {
        $name = "Fourth";
    }
    $pdf = new TCPDF();

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Virgo');
    $pdf->SetTitle('title');

    $pdf->SetFont('helvetica', 'b', 11);

    $pdf->AddPage();
    $pdf->Cell(0, 6, 'LANZ PIZZA', 0, 1, 'C');
    $pdf->Cell(0, 6, 'Sibalom, Antique', 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 13);
    $pdf->Cell(0, 10, ' Quarter SALES REPORT', 0, 1, 'C');
    $pdf->Cell(0, 8, $name. ' Quarter' .' of' . ' ' .$year, 0, 1, 'C');
    $pdf->Cell(0, 8, $start .' '.'to'  .' ' .$end, 0, 1, 'C');

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(15, 10, 'No.', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Month', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Total Orders', 1, 0, 'C');
    $pdf->Cell(60, 10, 'Total Sales', 1, 0, 'C');
    $pdf->Ln();
  

    $query = "SELECT date as date, count(*) as total_sales, sum(total_amount) as t_amount FROM orders 
          WHERE date between '$start_date' AND '$end_date' and status != 0 group by date";
          $result=mysqli_query($conn, $query);
  $count=mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
        $date = $row['date'];
        $date1 = new DateTime($date);
        $date1 =$date1->format('F d, Y');
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(15, 10, $sn++, 1, 0, 'C');
        $pdf->Cell(60, 10, $date1, 1, 0, 'C');
        $pdf->Cell(60, 10, $row['total_sales'], 1, 0, 'C');
        $pdf->Cell(60, 10, number_format($row['t_amount'], 2), 1, 0, 'C');
        $pdf->Ln();
    }



    $query1 = "SELECT SUM(total_amount) as total_sales FROM orders  WHERE date between '$start_date' AND '$end_date' and status != 0 ";
    $res1 = mysqli_query($conn, $query1);
    $row1=mysqli_fetch_assoc($res1);

    $total = number_format($row1['total_sales'], 2);

    $pdf->SetFont('helvetica', 'b', 11);
    $pdf->Cell(0, 10, 'Total Sales: ' . 'Php ' . $total, 0, 1, 'C');
}

$pdf->Output('report1.pdf', 'I');

$pdf->AutoPrint();
header('Location: daily_reports.php');

exit();
?>
