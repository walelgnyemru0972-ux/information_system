<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
if ($_SESSION['role'] !== 'admin') { header("Location: ../dashboard.php"); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username=trim($_POST['username']??''); $full=trim($_POST['full_name']??''); $email=trim($_POST['email']??'');
    $password=$_POST['password']??''; $role=$_POST['role']??'staff';
    if ($username==='' || $full==='' || $password==='') $error='Username, full name and password are required.';
    else {
        try {
            $stmt=$pdo->prepare("INSERT INTO users(username,password,full_name,email,role) VALUES(?,?,?,?,?)");
            $stmt->execute([$username,password_hash($password,PASSWORD_DEFAULT),$full,$email,$role]);
            header("Location: users.php"); exit;
        } catch(PDOException $e){ $error='Username may already exist.'; }
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Add User</h2></div><?php if($error): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
<div class="panel"><form method="post" class="form-grid">
<label>Username<input name="username" required></label><label>Full Name<input name="full_name" required></label>
<label>Email<input type="email" name="email"></label><label>Role<select name="role"><option value="staff">Staff</option><option value="admin">Admin</option></select></label>
<label>Password<input type="password" name="password" required></label>
<div><button class="btn btn-primary">Save</button> <a class="btn" href="users.php">Cancel</a></div>
</form></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>