<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $data=[trim($_POST['course_code']??''),trim($_POST['course_name']??''),(int)($_POST['credit_hours']??3),trim($_POST['department']??''),trim($_POST['description']??'')];
 if($data[0]===''||$data[1]===''||$data[3]==='')$error='Course code, name and department are required.';
 else try{$stmt=$pdo->prepare("INSERT INTO courses(course_code,course_name,credit_hours,department,description) VALUES(?,?,?,?,?)");$stmt->execute($data);header("Location: courses.php");exit;}catch(PDOException $e){$error='Course code may already exist.';}
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Add Course</h2></div><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?>
<div class="panel"><form method="post" class="form-grid"><label>Course Code<input name="course_code" required></label><label>Course Name<input name="course_name" required></label><label>Credit Hours<input type="number" name="credit_hours" min="1" max="12" value="3" required></label><label>Department<input name="department" required></label><label class="full">Description<textarea name="description" rows="4"></textarea></label><div><button class="btn btn-primary">Save</button> <a class="btn" href="courses.php">Cancel</a></div></form></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>