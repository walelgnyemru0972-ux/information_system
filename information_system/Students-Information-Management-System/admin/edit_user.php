<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../config/database.php';
if ($_SESSION['role'] !== 'admin') { header("Location: ../dashboard.php"); exit; }
$id=(int)($_GET['id']??0);
$stmt=$pdo->prepare("SELECT * FROM users WHERE id=?"); $stmt->execute([$id]); $u=$stmt->fetch();
if(!$u){header("Location: users.php");exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $full=trim($_POST['full_name']??''); $email=trim($_POST['email']??''); $role=$_POST['role']??'staff'; $password=$_POST['password']??'';
    if($full==='') $error='Full name is required.';
    else {
        if($password!==''){
            $stmt=$pdo->prepare("UPDATE users SET full_name=?,email=?,role=?,password=? WHERE id=?");
            $stmt->execute([$full,$email,$role,password_hash($password,PASSWORD_DEFAULT),$id]);
        } else {
            $stmt=$pdo->prepare("UPDATE users SET full_name=?,email=?,role=? WHERE id=?");
            $stmt->execute([$full,$email,$role,$id]);
        }
        header("Location: users.php"); exit;
    }
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Edit User</h2></div><?php if($error): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
<div class="panel"><form method="post" class="form-grid">
<label>Username<input value="<?=htmlspecialchars($u['username'])?>" disabled></label><label>Full Name<input name="full_name" value="<?=htmlspecialchars($u['full_name'])?>" required></label>
<label>Email<input type="email" name="email" value="<?=htmlspecialchars($u['email']??'')?>"></label>
<label>Role<select name="role"><option value="staff" <?=$u['role']==='staff'?'selected':''?>>Staff</option><option value="admin" <?=$u['role']==='admin'?'selected':''?>>Admin</option></select></label>
<label>New Password<input type="password" name="password" placeholder="Leave blank to keep current"></label>
<div><button class="btn btn-primary">Update</button> <a class="btn" href="users.php">Cancel</a></div>
</form></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>