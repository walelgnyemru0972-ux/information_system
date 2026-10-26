<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
if ($_SESSION['role'] !== 'admin') { header("Location: ../dashboard.php"); exit; }
$userCount = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><div><h2>Admin Dashboard</h2><p class="muted">System administration.</p></div></div>
<div class="cards"><div class="stat-card"><span>Total Users</span><strong><?= $userCount ?></strong></div></div>
<div class="panel"><div class="panel-header"><h3>Administration</h3></div>
<p>Manage system accounts from the users page.</p>
<a class="btn btn-primary" href="users.php">Manage Users</a></div>
</main></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>