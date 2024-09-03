<?php include 'condb.php' ?>

<!DOCTYPE html>
<html>
<head>
    <title>หน้า Login</title>
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>
    <div class="login-box">
        <h2 style="color: white;">เข้าสู่ระบบ</h2>
        <form method="post" action="process_login.php">
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit" style="margin-right: 115px;">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                เข้าสู่ระบบ
            </button>
            <button type="button" style="background-color: #BEDC74;" onclick="window.location.href='register.php';">สมัครสมาชิก</button>
        </form>
    </div>
</body>
</html>
