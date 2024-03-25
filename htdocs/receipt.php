<?php 
session_start();
$c_id = $_SESSION['customer_id'];
PDF_receipt($c_id);
function PDF_receipt($id){
include('DataBase/connect.php');
require ('assets/fpdf/mem_image.php');
	
	$result_receipt = mysqli_query($con, "SELECT * FROM customer WHERE customer_id = ".$id) or die($con->error);
	$row_receipt = $result_receipt->fetch_assoc();

	$pdf = new PDF_MemImage('P', 'mm', 'A4');
	$pdf->AddPage();
	$pdf->SetFont('Courier', '', 12);

	//Image and Date as Header
	$pdf->Image("assets/img/redjoy's.png",null,10,100,40);
	$pdf->Cell(120, 10, "", 0, 0);
	$pdf->Cell(70, 10, "Date: ".$row_receipt['date'], 0, 1);

	//Right Menu For Header
	$pdf->Cell(120, 10, "", 0, 0);
	$pdf->Cell(70, 10, "Customer Number: ".$row_receipt['customer_id'], 0, 1);	

	$pdf->Cell(120, 10, "", 0, 0);
	$pdf->Cell(70, 10, "Status: ".$row_receipt['status'], 0, 1);
	
	//Name
	$pdf->SetFont('Arial', 'B', 18);
	$pdf->Cell(80, 25,  $row_receipt['first_name']." ".$row_receipt['last_name'], 0, 1, 'C');

	//Information
	$pdf->SetFont('Courier', '', 12);
	$pdf->Cell(95, 10, "Contcat Number: ".$row_receipt['contact_no'], 1, 0);
	$pdf->Cell(95, 10, "Email: ".$row_receipt['email'], 1, 1);
	$pdf->Cell(150, 10, "Adress: ".$row_receipt['address'], 1, 0);
	$pdf->Cell(40, 10, "Zip Code: ".$row_receipt['zip'], 1, 1);
	$pdf->Cell(95, 10, "City: ".$row_receipt['city'], 1, 0);
	$pdf->Cell(95, 10, "Province: ".$row_receipt['province'], 1, 1);
	$pdf->Cell(95, 10, "Mode of Payment: ".$row_receipt['m_pay'], 1, 0);
	$pdf->Cell(95, 10, "Related Information: #", 1, 1);

	//Blank Space For Order
	$pdf->Ln(15);

	//Order
	$pdf->Cell(71, 10, "Product Name", 1, 0, 'C');
	$pdf->Cell(50, 10, "Image", 1, 0, 'C');
	$pdf->Cell(23, 10, "Price", 1, 0, 'C');
	$pdf->Cell(23, 10, "Quantity", 1, 0, 'C');
	$pdf->Cell(23, 10, "Amount", 1, 1, 'C');

	//Order Items
	$pdf->SetFont('Times', '', 12);

	$result_pdf = mysqli_query($con,"SELECT * FROM redjoy.order JOIN product ON redjoy.order.product_id = product.product_id WHERE customer_id = ".$id) or die($con->error);
	while($row_pdf = $result_pdf->fetch_assoc()):
		$pdf->Cell(71, 25, $row_pdf['product_name'], 1, 0, 'C');
		$image = $row_pdf['product_img'];
		$pdf->Cell(50, 25, $pdf->MemImage($image, $pdf->GetX()+10, $pdf->GetY(), 30, 25), 1, 0, 'C');
		$pdf->Cell(23, 25, $row_pdf['product_price'], 1, 0, 'C');
		$pdf->Cell(23, 25, $row_pdf['quantity'], 1, 0, 'C');
		$pdf->Cell(23, 25, $row_pdf['price'], 1, 1, 'C');
	endwhile;

	//Total
	$pdf->SetFont('Courier', '', 12);
	$pdf->Ln(10);
	$pdf->Cell(100, 10, '', 0, 0);
	$result_receipt_order = mysqli_query($con, "SELECT COUNT(product_name) FROM redjoy.order WHERE customer_id = ".$id) or die($con->error);
	$row_order = $result_receipt_order->fetch_assoc();
	$order_no = $row_order['COUNT(product_name)'];
	$pdf->Cell(45, 10, 'Orders: '.$order_no.' item', 1, 0);
	$pdf->Cell(45, 10, 'Total: '.$row_receipt['total'], 1, 1);
	$pdf->Output();
 }
 ?>