<?php require_once '../inc/connection.php' ?>
<?php require_once '../fpdf/fpdf.php' ?>
<?php


if (!isset($_SESSION['user_id'])) {
    
    header("Location: errorpage.php");
    exit(); 
}



// catchig order data
# catch prices
$query = "select `first_price` , `final_price` from orders where `order_number` = {$_SESSION['order_id']} and `user_id` = {$_SESSION['user_id']}";
$runQuery = mysqli_query($conn,$query);
$order_prices = mysqli_fetch_assoc($runQuery);

# catch details
$query = "select * from order_details where `order_number` = {$_SESSION['order_id']}";
$runQuery = mysqli_query($conn,$query);
$order_products = mysqli_fetch_all($runQuery,MYSQLI_ASSOC);

$pdf = new FPDF('p','mm','A4');

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);

// center cell
$pdf->Cell(50,10,'',0,0,);
$pdf->Cell(89,10,'Receipt',0,1,"C");
# blank cell
$pdf->Cell(0,20,'',0,1);
# order number
$pdf-> Cell(32,10,'Order Number : ',0);
$pdf-> Cell(5,10,"{$_SESSION['order_id']}",0,1);
# user name
$pdf-> Cell(27,10,'User Name : ',0);
$pdf-> Cell(0,10,"{$_SESSION['user_name']}",0,1);


$pdf->Cell(0,10,'',0,1);
$pdf->Cell(100,10,'Order Details',0,1);


// table of contents
#header
$pdf->Cell(80,10,'Product Name',1,0,"C");
$pdf->Cell(30,10,"Quantity","TRB",0,"C");
$pdf->Cell(40,10,"Price Each","TRB",0,"C");
$pdf->Cell(30,10,"SubTotal","TRB",1,"C");
$order_total = 0;
foreach($order_products as $product){
    $query = "select `title` from products where product_number = {$product['product_number']} ";
    $runQuery = mysqli_query($conn,$query);
    $product_name = mysqli_fetch_assoc($runQuery);
    $total = $product['quantity'] * $product['price_each'];
    $order_total += $total;
    $pdf->Cell(80,10,"{$product_name['title']}","LRB",0,"C");
    $pdf->Cell(30,10,"{$product['quantity']}","RB",0,"C");
    $pdf->Cell(40,10,"{$product['price_each']}","RB",0,"C");
    $pdf->Cell(30,10,"$total","RB",1,"C");
}
$pdf->Cell(150,10,'Order Total',"LRB",0,"C");
$pdf->Cell(30,10,"$order_total","RB",1,"C");

$pdf->Cell(0,20,'',0,1);
$pdf->Cell(37,10,'Order First Price : ',0,0,"L");
$pdf->Cell(30,10,"{$order_prices['first_price']}",0,1,"L");

$pdf->Cell(0,5,'',0,1);
$pdf->Cell(37,10,'Order Final Price : ',0,0,"L");
$pdf->Cell(30,10,"{$order_prices['final_price']}",0,1,"L");

// var_dump(array_keys($_SESSION));
// echo "<hr>";
// var_dump($order_prices);
// echo "<hr>";
// var_dump($order_products);


$pdf->Output('I','25');


