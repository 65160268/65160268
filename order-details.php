<?php
session_start();
include 'condb.php'; 

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
} else {
    echo "No product found.";
    exit;
}

$sql = "SELECT * FROM product WHERE product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $total_price = $product['product_price'] * $quantity;
} else {
    echo "No product found.";
    exit;
}

//

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order payment</title>
    <link rel="stylesheet" href="Css/order-details.css">
    <script src="JS/order-details.js"></script>
</head>
<body>
    <div class="container"></div>
        <div class="detail">
            <h1>2nd-Hand-Store</h1>
            <div class="order-detail">
                <img class="img-detail" src="images/<?php echo $product['product_img']; ?>" alt="Product Image">
                <div class="product-info">
                    <h2>ชื่อสินค้า :</h2>
                    <p><?php echo $product['product_description']; ?></p>
                    <p class="price">Price: <b style="color: red;">฿<?php echo number_format($product['product_price'], 2); ?></b></p>
                </div>
            </div>
            <p>ยอดสั่งซื้อทั้งหมด (<b style="color: red;"><?php echo $quantity; ?></b>) รายการ: <b style="color: red;">฿<?php echo number_format($total_price, 2); ?></b></p>

        </div>
        <div class="address">
            <h4>ที่อยู่จัดส่งสินค้า</h4>
            <p>Phoowadon Teekhao (+66) 99 999 9999</p>
            <p>99/99 Chonburi 20000</p>
        </div>
        <div class="pay-detail">
            <h4>รายละเอียดการจ่ายเงิน</h4>
            <div class="price-item">
                <p>ยอดรวมสินค้า</p>
                <p><b style="color: red;">฿<?php echo number_format($total_price, 2); ?></b></p>
            </div>
            <div class="price-item">
                <p>ยอดรวมค่าจัดส่ง</p>
                <p>฿0</p>
            </div>
            
            <h3>ค่าใช้จ่ายทั้งหมด</h3>
            <h3><b style="color: red;">฿<?php echo number_format($total_price, 2); ?></b></h3>
        </div>
        <div class="footer">
            <h2>ยอดรวมทั้งหมด</h2>
            <h2><b style="color: red;">฿<?php echo number_format($total_price, 2); ?></b></h2>
            <form action="card-option V2.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <input type="hidden" name="product_description" value="<?php echo $product['product_description']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
                <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
                <button type="submit" class="butt-order">สั่งซื้อสินค้า</button>
            </form>
        </div>
    </div>
</body>
</html>
