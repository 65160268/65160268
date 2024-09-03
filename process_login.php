<?php
session_start();

include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement (recommended)
    $stmt = $conn->prepare("SELECT user_id, user_pass FROM users WHERE user_id = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_pass'])) {
            // Store user ID in session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['login'] = true;
            header("Location: mainstore.php");
            exit();
        } else {
            // Incorrect password
            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        // User not found
        $_SESSION['error'] = "ไม่พบชื่อผู้ใช้";
    }
    header("Location: login.php"); // Redirect back to login page
}
