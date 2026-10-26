<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=[
        trim($_POST['student_no']??''),trim($_POST['first_name']??''),trim($_POST['last_name']??''),
        $_POST['gender']??'',trim($_POST['dob']??''),trim($_POST['phone']??''),trim($_POST['email']??''),
        trim($_POST['department']??''),(int)($_POST['year_level']??1),trim($_POST['address']??'')
    ];
    if($data[0]===''||$data[1]===''||$data[2]===''||$data[7]==='') $error='Student number, first name, last name and department are required.';
    else try{$stmt=$pdo->prepare("INSERT INTO students(student_no,first_name,last_name,gender,date_of_birth,phone,email,department,year_level,address) VALUES(?,?,?,?,?,?,?,?,?,?)");$stmt->execute($data);header("Location: students.php");exit;}catch(PDOException $e){$error='Student number may already exist.';}
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content"><div class="page-heading"><h2>Add Student</h2></div>
<?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?>
<div class="panel"><form method="post" class="form-grid">
<label>Student Number<input name="student_no" required></label><label>First Name<input name="first_name" required></label><label>Last Name<input name="last_name" required></label>
<label>Gender<select name="gender"><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select></label>
<label>Date of Birth<input type="date" name="dob"></label><label>Phone<input name="phone"></label><label>Email<input type="email" name="email"></label>
<label>Department<input name="department" required></label><label>Year Level<select name="year_level"><?php for($i=1;$i<=8;$i++):?><option><?=$i?></option><?php endfor;?></select></label>
<label class="full">Address<textarea name="address" rows="3"></textarea></label>
<div><button class="btn btn-primary">Save Student</button> <a class="btn" href="students.php">Cancel</a></div>
</form></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>