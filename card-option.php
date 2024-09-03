<?php
include 'condb.php';  // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีข้อมูลถูกส่งมาผ่าน POST หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ดึงข้อมูลจากฟอร์ม POST
    $product_name = $_POST['product_name'];
    $product_price_per_unit = $_POST['product_price'];  // ราคาต่อหน่วย
    $quantity = $_POST['quantity'];  // จำนวนสินค้า

    // คำนวณราคาสินค้ารวม
    $total_price = $product_price_per_unit * $quantity;
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
    <title>Payment option</title>
    <link href="Css/card.css" rel="stylesheet">
    <script src="JS/card-option.js"></script>
</head>
<body>
    <header class="header">
        <!-- Header content -->
    </header>

    <div class="container">
        <aside class="sidebar">
            <h2>วิธีการชำระเงิน</h2>
            <hr>
            <div class="methods">
                <div onclick="doFun()" id="tColorA" style="color: rgb(38, 24, 238);"><i class="fas fa-credit-card" style="color: rgb(38, 24, 238);"></i> ชำระเงินด้วยบัตร</div>
                <div onclick="doFunA()" id="tColorB"><i class="fas fa-building-columns"></i> แอพธนาคาร</div>
                <div onclick="doFunB()" id="tColorC"><i class="fas fa-wallet"></i> Apple/Google pay</div>
                <hr>
            </div>
        </aside>
        
        <main class="main-content">
        <a href="https://www.shift4shop.com/credit-card-logos.html"><img alt="Credit Card Logos" title="Credit Card Logos" src="https://www.shift4shop.com/images/credit-card-logos/cc-lg-5.png" width="518" height="59"  /></a>
            <div class="card-details">
                <form id="payment-form" action="payment-success.php" method="POST">
                    <!-- ส่งข้อมูลสินค้าไปยัง payment-success.php -->
                    <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $product_price_per_unit; ?>">
                    <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">

                    <p>Card Number</p>
                    <div class="c-number">
                        <input id="number" class="cc-number" placeholder="Card number" maxlength="19" required>
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <p>Cardholder Name</p>
                    <div class="c-number">
                        <input id="cardholder-name" class="cc-number" placeholder="Cardholder Name" maxlength="19" required>
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="c-details">
                        <div>
                            <p>Expiry Date</p>
                            <input id="e-date" class="cc-exp" placeholder="MM/DD/YYYY" required maxlength="10" oninput="formatExpiryDate()" />
                        </div>
                        <div>
                            <p>CVV</p>
                            <input id="cvv" class="cc-cvv" placeholder="CVV" required maxlength="3">
                        </div>
                    </div>
                    <div class="email">
                        <p>Email</p>
                        <input type="email" placeholder="Example@email.com" id="email" required>
                    </div>
                    <button type="submit">จ่ายตอนนี้</button>
                </form>
            </div>
        </main>

        <aside class="sidebar">
            <h2>ข้อมูลการสั่งซื้อ</h2>
            <div class="details">
                <div style="font-weight: bold; padding: 3px 0;">รายละเอียดการสั่งซื้อ</div>
                <img class="img-detail" src="images/<?php echo $product['product_img']; ?>" alt="Product Image">
                <p>ชื่อสินค้า: <?php echo $product_name; ?></p>
                <p>จำนวน: <?php echo $quantity; ?> ชิ้น</p>
                <p>ราคาสินค้ารวม: ฿<?php echo number_format($total_price, 2); ?></p>
            </div>
        </aside>
    </div>

    <footer class="footer">
        <!-- Footer content -->
    </footer>
    <script>
let tColorA = document.getElementById('tColorA'),
    tColorB = document.getElementById('tColorB'),
    tColorC = document.getElementById('tColorC'),
    iconA = document.querySelector('.fa-credit-card'),
    iconB = document.querySelector('.fa-building-columns'),
    iconC = document.querySelector('.fa-wallet'),
    cDetails = document.querySelector('.card-details');

function doFun() {
    tColorA.style.color = "Blue";
    tColorB.style.color = "#444";
    tColorC.style.color = "#444";
    iconA.style.color = "Blue";
    iconB.style.color = "#aaa";
    iconC.style.color = "#aaa";
    cDetails.style.display  = "block";
}

function doFunA() {
    tColorA.style.color = "#444";
    tColorB.style.color = "Blue";
    tColorC.style.color = "#444";
    iconA.style.color = "#aaa";
    iconB.style.color = "Blue";
    iconC.style.color = "#aaa";
    cDetails.style.display  = "none";
}

function doFunB() {
    tColorA.style.color = "#444";
    tColorB.style.color = "#444";
    tColorC.style.color = "Blue";
    iconA.style.color = "#aaa";
    iconB.style.color = "#aaa";
    iconC.style.color = "Blue";
    cDetails.style.display  = "none";
}

    </script>
</body>
</html>
