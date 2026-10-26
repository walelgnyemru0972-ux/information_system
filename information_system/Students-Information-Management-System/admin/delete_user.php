<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
if ($_SESSION['role'] !== 'admin') { header("Location: ../dashboard.php"); exit; }
$id=(int)($_GET['id']??0);
if($id && $id !== (int)$_SESSION['user_id']) { $stmt=$pdo->prepare("DELETE FROM users WHERE id=?"); $stmt->execute([$id]); }
header("Location: users.php"); exit;
?>