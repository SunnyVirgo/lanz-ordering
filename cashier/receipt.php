<?php
require_once '../TCPDF-main/tcpdf.php';
include '../config/constant.php';

// create new PDF document
$pdf = new TCPDF();

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Receipt');

// set font
$pdf->SetFont('helvetica', 'b', 13);

// add a page
$query="SELECT * FROM settings";
$result=mysqli_query($conn,$query);
$rows=mysqli_fetch_assoc($result);
$pdf->AddPage();
$pdf->Cell(0, 10, $rows['name'], 0, 1, 'C');
$pdf->Cell(0, 10, $rows['address'], 0, 1, 'C');
$pdf->Cell(0, 10, $rows['contact'], 0, 1, 'C');
$pdf->Cell(0, 10, $rows['email'], 0, 1, 'C');
$pdf->Cell(0, 10, ' Non Official Receipt', 0, 1, 'C');
$pdf->Ln();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
  

    $sql = "SELECT * FROM orders WHERE id = '$id' AND status !=0";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    if($row['type'] == "in")
    {
        $type = "DINE - IN";
    }
    else
    {
        $type= "TAKE - OUT";
    }

    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(100, 7, 'Cashier: ' . $row['cashier'], 0, 1);
    $pdf->MultiCell(100, 7, 'Customer Name: ' . $row['name'], 0, 1);
    $pdf->MultiCell(100, 7, 'Transaction Code: ' . $row['tcode'], 0, 1);
    $pdf->MultiCell(100, 7, 'Receipt Number: ' . $row['receipt'], 0, 1);
    $pdf->MultiCell(100, 7, 'Date: ' . $row['date'], 0, 1);
    $pdf->MultiCell(100, 7, 'Time: ' . $row['update_time'], 0, 1);
    $pdf->Ln();
    $pdf->Write(
        0,
        '----------------------------------------------------'.'  '.$type.'  '.'-----------------------------------------------------------',
        0,
        0
    );
    $pdf->Ln();
    $pdf->MultiCell(50, 7, 'Order Details: ', 0, 1);

    $pdf->Cell(60, 10, 'Item Name', 0, 0, 'C');
    $pdf->Cell(40, 10, 'Price', 0, 0, 'C');
    $pdf->Cell(40, 10, 'Quantity', 0, 0, 'C');
    $pdf->Cell(40, 10, 'Total Price', 0, 0, 'C');
    $pdf->Cell(10, 10, 'VAT', 0, 0, 'C');
    $pdf->Ln();
    $sql1 = "SELECT m.*, c.food_name as `food_name`, c.price as `price`, c.withvat as `withvat` from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '$id'";
    $res1 = mysqli_query($conn, $sql1);
    $count1 = mysqli_num_rows($res1);

    if ($count1 > 0) {
        while ($row1 = mysqli_fetch_assoc($res1)) {
            if($row1['withvat'] == 1){
                $vat = "V";
            }
            else
            {
                $vat = " ";
            }
            $pdf->Cell(60, 7, $row1['food_name'], 0, 0, 'C');
            $pdf->Cell(40, 7, $row1['price'], 0, 0, 'C');
            $pdf->Cell(40, 7, $row1['qnty'], 0, 0, 'C');
            $pdf->Cell(40, 7, $row1['total_price'], 0, 0, 'C');
            $pdf->Cell(10, 7, $vat, 0, 0, 'C');
            $pdf->Ln();
        }
    }

    $pdf->Write(
        0,
        '--------------------------------------------------------------------------------------------------------------------------------',
        0,
        0
    );
    $pdf->Ln();
    $pdf->Ln();
    $pdf->Ln();

    $sql1 = "SELECT SUM(od.total_price) AS total_price_sum
FROM order_details AS od
INNER JOIN tbl_food AS tf ON od.food_id = tf.id
WHERE tf.withvat = 1 AND od.order_id = '$id'
";
    $res1 = mysqli_query($conn, $sql1);
    $row3 = mysqli_fetch_assoc($res1);

    $sql4 = "SELECT SUM(od.total_price) AS total_price_sum1
FROM order_details AS od
INNER JOIN tbl_food AS tf ON od.food_id = tf.id
WHERE tf.withvat = 0 AND od.order_id = '$id'
";
    $res4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($res4);

    // $sql2 = "SELECT SUM(total_price)  AS sum from order_details WHERE order_id=$order_id";



    $sql2 = "SELECT vat_percentage FROM settings";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    $pdf->MultiCell(100, 7, 'VAT Percentage: '  . $row2['vat_percentage'] .'%', 0, 1);
    $pdf->MultiCell(
        100,
        7,
        'VATable Sales: ' . 'Php ' . number_format($row3['total_price_sum'], 2),
        0,
        1
    );
    $pdf->MultiCell(100, 7, 'VAT-Exempt Sales: ' . 'Php ' . number_format($row4['total_price_sum1'], 2), 0, 1);
    $vat = $row2['vat_percentage'] / 100;
    $vat_amount = $vat * $row3['total_price_sum'];
    $pdf->MultiCell(100, 7, 'VAT Amount: ' . 'Php ' . number_format($vat_amount,2), 0, 1);
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('helvetica', 'b', 12);
    $pdf->MultiCell(180, 15, 'Total: ' . 'Php' . number_format($row['total_amount'], 2), 0, 0);

    $pdf->SetFont('helvetica', '', 12);
    $pdf->MultiCell(
        100,
        7,
        'Amount Payable: ' . 'Php ' . number_format($row['total_amount'], 2),
        0,
        1
    );
    $pdf->MultiCell(100, 7, 'Cash: ' . 'Php ' . number_format($row['tendered_amount'], 2), 0, 1);
    $pdf->MultiCell(100, 7, 'Change: ' . 'Php ' . number_format($row['change_amount'], 2), 0, 1);
    $pdf->Ln();


    // $sql1 = "SELECT m.*, SUM(c.total_price) as sum from `order_details` m inner join tbl_food c on m.food_id = c.id where m.order_id = '$id' and m.withvat = 1";

    $pdf->SetFont('helvetica', 'i', 8);
    $pdf->Write(
        0,
        'NOTE: "This receipt is system generated and it is not official."',
        0,
        0
    );
}
$pdf->Output('report.pdf', 'I');

header('Location: index.php');

exit();
?>
