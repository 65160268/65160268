<?php
session_start();
session_destroy(); // Destroy all session data
header("Location: mainstore.php"); // Redirect to mainstore.php
exit();
