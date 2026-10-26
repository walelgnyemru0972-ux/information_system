<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$id=(int)($_GET['id']??0);$stmt=$pdo->prepare("SELECT * FROM students WHERE id=?");$stmt->execute([$id]);$s=$stmt->fetch();if(!$s){header("Location: students.php");exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $data=[trim($_POST['first_name']??''),trim($_POST['last_name']??''),$_POST['gender']??'',trim($_POST['dob']??''),trim($_POST['phone']??''),trim($_POST['email']??''),trim($_POST['department']??''),(int)($_POST['year_level']??1),trim($_POST['address']??''),$id];
 if($data[0]===''||$data[1]===''||$data[6]==='')$error='First name, last name and department are required.';
 else{$stmt=$pdo->prepare("UPDATE students SET first_name=?,last_name=?,gender=?,date_of_birth=?,phone=?,email=?,department=?,year_level=?,address=? WHERE id=?");$stmt->execute($data);header("Location: students.php");exit;}
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content"><div class="page-heading"><h2>Edit Student</h2></div>
<?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?>
<div class="panel"><form method="post" class="form-grid">
<label>Student Number<input value="<?=htmlspecialchars($s['student_no'])?>" disabled></label><label>First Name<input name="first_name" value="<?=htmlspecialchars($s['first_name'])?>" required></label><label>Last Name<input name="last_name" value="<?=htmlspecialchars($s['last_name'])?>" required></label>
<label>Gender<select name="gender"><?php foreach(['','Male','Female','Other'] as $g):?><option <?=$s['gender']===$g?'selected':''?>><?=$g?></option><?php endforeach;?></select></label>
<label>Date of Birth<input type="date" name="dob" value="<?=htmlspecialchars($s['date_of_birth']??'')?>"></label><label>Phone<input name="phone" value="<?=htmlspecialchars($s['phone']??'')?>"></label><label>Email<input type="email" name="email" value="<?=htmlspecialchars($s['email']??'')?>"></label>
<label>Department<input name="department" value="<?=htmlspecialchars($s['department'])?>" required></label><label>Year Level<select name="year_level"><?php for($i=1;$i<=8;$i++):?><option <?=$s['year_level']==$i?'selected':''?>><?=$i?></option><?php endfor;?></select></label>
<label class="full">Address<textarea name="address" rows="3"><?=htmlspecialchars($s['address']??'')?></textarea></label>
<div><button class="btn btn-primary">Update Student</button> <a class="btn" href="students.php">Cancel</a></div>
</form></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>