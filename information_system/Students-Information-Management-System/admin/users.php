<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
if ($_SESSION['role'] !== 'admin') { header("Location: ../dashboard.php"); exit; }
$users = $pdo->query("SELECT id, username, full_name, email, role, created_at FROM users ORDER BY id DESC")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Users</h2><a class="btn btn-primary" href="add_user.php">Add User</a></div>
<div class="panel table-wrap"><table><thead><tr><th>Username</th><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead><tbody>
<?php foreach($users as $u): ?><tr>
<td><?= htmlspecialchars($u['username']) ?></td><td><?= htmlspecialchars($u['full_name']) ?></td><td><?= htmlspecialchars($u['email'] ?? '') ?></td><td><?= htmlspecialchars($u['role']) ?></td>
<td><a class="btn btn-sm" href="edit_user.php?id=<?= $u['id'] ?>">Edit</a> <a class="btn btn-sm btn-danger" data-confirm="Delete this user?" href="delete_user.php?id=<?= $u['id'] ?>">Delete</a></td>
</tr><?php endforeach; ?>
</tbody></table></div></main></div>
<?php include __DIR__ . '/../includes/footer.php'; ?>