<!DOCTYPE html>
<html>
<head>
    <title>หน้า Register</title>
    <link rel="stylesheet" href="Css/register.css">
</head>
<body>
    <div class="register-box">
        <h2 style="color: black;">สมัครสมาชิก</h2>
        <form method="post" action="process_register.php">
            <div class="user-box">
                <input type="text" name="username" required>
                <label>Username</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <div class="user-box">
                <input type="password" name="confirm_password" required>
                <label>Confirm Password</label>
            </div>
            <div class="user-box">
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="user-box">
                <input type="tel" name="phone" required>
                <label>Phone</label>
            </div>
            <label style="color: black;">Select User Group</label>
            <div class="user-box">
                <select name="user_group" required>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>
            <button type="submit" style="margin-right: 115px;">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                สมัครสมาชิก
            </button>
        </form>
    </div>
</body>
</html>
