<?php
session_start();
include 'condb.php';

// Check if the user is logged in
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    $user_id = $_SESSION['user_id'];

    // Retrieve the username and user group from the database
    $stmt = $conn->prepare("SELECT user_id, user_group FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $username = $user['user_id'];
    $user_group = $user['user_group'];
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="Css/index.css" rel="stylesheet">
    <script src="JS/index.js"></script>
    <script>
        function toggleSidebar() {
            const container = document.querySelector('.container');
            const aside = document.querySelector('aside');
            const delay = 300; // Delay in milliseconds

            if (container.classList.contains('sidebar-collapsed')) {
                aside.style.display = 'block';
                setTimeout(() => {
                    container.classList.remove('sidebar-collapsed');
                }, 10);
            } else {
                container.classList.add('sidebar-collapsed');
                setTimeout(() => {
                    aside.style.display = 'none';
                }, delay);
            }
        }
    </script>
</head>
<body>
<div class="products-container"></div>      
    <header>
        <div class="nav">
            <span class="nav">หน้าหลัก</span>
            <div class="button-container">
                <?php
                if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                    // Display username with user group and logout button if logged in
                    echo '<span class="username-display">ยินดีต้อนรับ, '.$username.' ('.$user_group.')&nbsp;</span>';
                    if ($user_group == 'seller') {
                        echo '<button class="gray-button" onclick="window.location.href=\'add_product.php\';">เพิ่มสินค้า</button>';
                    }
                    echo '<button class="gray-button" onclick="window.location.href=\'logout.php\';">ออกจากระบบ</button>';
                } else {
                    // Display login and register buttons if not logged in
                    echo '<button class="notification-button">การแจ้งเตือน</button>';
                    echo '<button class="white-button">ภาษา</button>';
                    echo '<button class="white-button">ติดต่อ</button>';
                    echo '<button class="gray-button" onclick="window.location.href=\'login.php\';">เข้าสู่ระบบ</button>';
                    echo '<button class="black-button" onclick="window.location.href=\'register.php\';">ลงทะเบียน</button>';
                }
                ?>
            </div>
        </div>
    </header>
    <div class="container">
        <button class="toggle-sidebar" onclick="toggleSidebar()">☰</button>
        <aside>
            <div class="filter">
                <h3>ตั้งค่าการค้นหา</h3>
                <span>ตั้งค่าเพื่อค้นหาสินค้าที่ต้องการได้ง่ายขึ้น</span>
                <div class="keywords"></div>
                <h3>ราคา</h3>
                <div class="range-container">
                    <span id="price-display">0</span>
                    <input type="range" id="price-range" min="0" max="50000" step="500" value="0">
                    <span>50000</span>
                </div>
                <div style="display: flex; justify-content: center;">
                    <input type="checkbox" id="apply-range">
                    <label for="apply-range">ใช้ช่วงราคา</label>
                </div>
                <h3>ประเภทสินค้า</h3>
                <?php
                $sql = "SELECT * FROM category";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<input type="checkbox" class="category-filter" value="'.$row["category_id"].'"><label style="margin-left: 10px;">'.$row["category_name"].'</label><br>';
                    }
                } else {
                    echo "0 category";
                }
                ?>
                <h3>สินค้าสำหรับ</h3>
                <input type="checkbox" class="audience-filter" value="men"><label style="margin-left: 10px;">ผู้ชาย</label><br>
                <input type="checkbox" class="audience-filter" value="women"><label style="margin-left: 10px;">ผู้หญิง</label><br>
                <input type="checkbox" class="audience-filter" value="unisex"><label style="margin-left: 10px;">ทุกเพศ</label><br>
            </div>
        </aside>
        <main>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search">
                <button id="search-button" style="margin-left: 10px;">ค้นหา</button>
                <div class="sort-options">
                    <button id="lowest-price-button" class="black-button">ราคาต่ำสุด</button>
                    <button id="highest-price-button" class="black-button">ราคาสูงสุด</button>
                </div>
            </div>
            
            <div class="products">
                <?php
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="product-card" data-price="'.$row["product_price"].'" data-category="'.$row["product_group"].'" data-audience="men, women, unisex">
                                <a href="product.php?product_id='.$row["product_id"].'">
                                    <div class="product-image">
                                        <img src="images/'.$row["product_img"].'" alt="รูปภาพสินค้า">
                                    </div>
                                    <div class="product-text">'.$row["product_name"].'</div>
                                    <div class="product-price">฿'.$row["product_price"].'</div>
                                </a>
                            </div>';
                    }
                } else {
                    echo "0 product";
                }

                $conn->close();
                ?>
            </div>
        </main>
    </div>
    <footer class="footer">
        
    </footer>
</body>
</html>
