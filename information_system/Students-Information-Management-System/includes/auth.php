<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /Students-Information-Management-System/login.php");
    exit;
}
?>