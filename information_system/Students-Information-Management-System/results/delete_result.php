<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$id=(int)($_GET['id']??0);if($id){$stmt=$pdo->prepare("DELETE FROM results WHERE id=?");$stmt->execute([$id]);}header("Location: results.php");exit;
?>