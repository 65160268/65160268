<?php
session_start();
include 'condb.php';

// Check if the user is logged in and is a seller
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

// Retrieve categories for the form dropdown
$categories = [];
$category_sql = "SELECT category_id, category_name FROM category";
$category_result = $conn->query($category_sql);
if ($category_result->num_rows > 0) {
    while ($row = $category_result->fetch_assoc()) {
        $categories[] = $row;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_group = $_POST['product_group']; // This should be an ID
    $product_img = $_FILES['product_img']['name'];

    // Save the image to the images directory
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
    move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_file);

    // Insert the product into the database
    $stmt = $conn->prepare("INSERT INTO product (product_name, product_description, product_price, product_group, product_img) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $product_name, $product_description, $product_price, $product_group, $product_img);

    if ($stmt->execute()) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="css/add_product.css" rel="stylesheet">
</head>
<body>
    <div class="add-product-box">
        <h2>Add a New Product</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="product-box">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" required>
            </div>
            <div class="product-box">
                <label for="product_description">Product Description</label>
                <textarea name="product_description" id="product_description" required></textarea>
            </div>
            <div class="product-box">
                <label for="product_price">Price</label>
                <input type="number" name="product_price" id="product_price" step="0.01" required>
            </div>
            <div class="product-box">
                <label for="product_group">Product Category</label>
                <select name="product_group" id="product_group" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['category_id']; ?>">
                            <?php echo htmlspecialchars($category['category_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="product-box">
                <label for="product_img">Product Image</label>
                <input type="file" name="product_img" id="product_img" accept="image/*" required>
            </div>
            <button type="submit">Add Product</button>
            <button class="gray-button" onclick="window.location.href='mainstore.php';">Back to Store</button>
        </form>
    </div>
</body>
</html>
