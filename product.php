<?php include 'condb.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="Css/product.css" rel="stylesheet">
    <script src="JS/product.js"></script>
    <title>Product</title>
</head>
<body>
    <header class="header">
        <div class="button-flexstart">
            <div class="back-button"><a href="mainstore.php">กลับ</a></div>
        </div>
    </header>
    <div class="container">
        <aside class="sidebar">
            <?php
            if (isset($_GET['product_id'])) {
                $product_id = $_GET['product_id'];
                $sql = "SELECT * FROM product WHERE product_id = $product_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="img"><img src="images/' . $row["product_img"] . '" alt="Product Image"></div>';
                } else {
                    echo '<div class="img">Image not available</div>';
                }
            }
            ?>
        </aside>
        <main class="main-content">
            <?php
            if (isset($row)) {
                echo '<h1>' . $row["product_name"] . '</h1>';
                echo '<p>' . $row["product_description"] . '</p>';
                echo '<p>Price: ฿<span id="price">' . $row["product_price"] . '</span></p>';
                echo '
                <form id="orderForm" action="order-details.php" method="POST">
                    <input type="hidden" name="product_id" value="' . $row["product_id"] . '">
                    <input type="hidden" name="product_price" value="' . $row["product_price"] . '">
                    
                    <div class="quantity">
                        <label for="quantity">จำนวน</label>
                        <button type="button" onclick="decreaseQuantity()">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" onchange="updateTotalPrice()">
                        <button type="button" onclick="increaseQuantity()">+</button>
                    </div>
                    <div class="buttons">
                        <button type="button" class="add-to-cart">เพิ่มไปยังรถเข็น</button>
                        <button type="submit" class="buy-now">ซื้อสินค้า</button>
                    </div>
                </form>
                ';
            }
            ?>
        </main>
    </div>
    <footer class="footer">
    <div class="social-share">
        <span>แชร์ :</span>
        <a href="https://www.messenger.com/?_rdr"><img src="images/messenger.png" alt="Messenger"></a>
        <a href="https://www.facebook.com/"><img src="images/facebook.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/"><img src="images/instagram.png" alt="Instagram"></a>
        <a href="https://www.pinterest.com/"><img src="images/pinterest.png" alt="Pinterest"></a>
        <a href="https://x.com/"><img src="images/twitter.png" alt="Twitter"></a>
        <span class="separator">|</span>
        <a href="#" class="favorite"><img src="images/heart.png" alt="Favorite"> Favorite (9.9พัน)</a>
    </div>
    </footer>
    
</body>
</html>
