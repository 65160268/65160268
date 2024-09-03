<?php
session_start();
include 'condb.php';  // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีข้อมูลถูกส่งมาผ่าน POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับข้อมูลที่ส่งมาจากหน้า card-option V2.php
    $product_id = $_POST['product_id'];
    $product_description = isset($_POST['product_description']) ? $_POST['product_description'] : null;
    $product_price = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $total_price = $_POST['total_price'];
    
    // ตรวจสอบว่าข้อมูลถูกส่งมาครบถ้วนหรือไม่
    if ($product_id && $product_description && $product_price && $quantity && $total_price) {
        // echo "<h2>การสั่งซื้อเสร็จสมบูรณ์</h2>";
        // echo "<p>ชื่อสินค้า: $product_description</p>";
        // echo "<p>จำนวน: $quantity</p>";
        // echo "<p>ราคาต่อชิ้น: ฿" . number_format($product_price, 2) . "</p>";
        // echo "<p>ยอดรวมทั้งหมด: ฿" . number_format($total_price, 2) . "</p>";

        // สุ่มเลขคำสั่งซื้อ 6 หลัก
        $order_id = rand(100000, 999999);
        // echo "<p>หมายเลขคำสั่งซื้อของคุณคือ: $order_id</p>";
    } else {
        echo "ข้อมูลไม่ครบถ้วน กรุณาลองใหม่อีกครั้ง.";
    }
} else {
    // กรณีที่เข้าหน้าโดยตรงโดยไม่มีข้อมูล POST
    header("Location: mainstore.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" href="Css/payment-success.css">
</head>
<body>
    <header class="header">
        <!-- Header content -->
    </header>
    
    <div class="payment-success-container">
        <div class="payment-success-box">
            <img src="images/check.png" alt="Logo" class="logo">
            <h2>สั่งซื้อเรียบร้อย</h2>
            <div class="order-details">
                <p>เลขที่คำสั่งซื้อ: <b>#<?php echo $order_id; ?></b></p>
                <p>ชื่อสินค้า: <b><?php echo $product_description; ?></b></p>
                <p>จำนวน: <b><?php echo $quantity; ?> ชิ้น</b></p>
                <p>จำนวนเงินที่ได้ชำระ<b style="color: orange;">: ฿<?php echo number_format($total_price, 2); ?></b></p>
                <p>สถานะรายการสั่งซื้อ<b style="color: #4CAF50;">: ชำระเงินสำเร็จ</b></p>
            </div>
            <div class="back-button">
                <a href="mainstore.php">กลับสู่หน้าหลัก</a>
            </div>
        </div>
    </div>
    
    <div class="footer">
        <!-- Footer content -->
    </div>
</body>
</html>
