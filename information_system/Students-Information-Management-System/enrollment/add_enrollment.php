<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$students=$pdo->query("SELECT id,student_no,first_name,last_name FROM students ORDER BY student_no")->fetchAll();
$courses=$pdo->query("SELECT id,course_code,course_name FROM courses ORDER BY course_code")->fetchAll();$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 $data=[(int)($_POST['student_id']??0),(int)($_POST['course_id']??0),$_POST['semester']??'',trim($_POST['academic_year']??''),$_POST['enrollment_date']??date('Y-m-d')];
 if(!$data[0]||!$data[1]||$data[2]===''||$data[3]==='')$error='All enrollment fields are required.';
 else try{$stmt=$pdo->prepare("INSERT INTO enrollments(student_id,course_id,semester,academic_year,enrollment_date) VALUES(?,?,?,?,?)");$stmt->execute($data);header("Location: enrollment.php");exit;}catch(PDOException $e){$error='This student is already enrolled in the selected course/semester.';}
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Add Enrollment</h2></div><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?>
<div class="panel"><form method="post" class="form-grid"><label class="full">Student<select name="student_id" required><option value="">Select student</option><?php foreach($students as $s):?><option value="<?=$s['id']?>"><?=htmlspecialchars($s['student_no'].' - '.$s['first_name'].' '.$s['last_name'])?></option><?php endforeach;?></select></label>
<label class="full">Course<select name="course_id" required><option value="">Select course</option><?php foreach($courses as $c):?><option value="<?=$c['id']?>"><?=htmlspecialchars($c['course_code'].' - '.$c['course_name'])?></option><?php endforeach;?></select></label>
<label>Semester<select name="semester"><option>Semester 1</option><option>Semester 2</option><option>Summer</option></select></label><label>Academic Year<input name="academic_year" placeholder="2026/2027" required></label><label>Enrollment Date<input type="date" name="enrollment_date" value="<?=date('Y-m-d')?>"></label>
<div><button class="btn btn-primary">Enroll</button> <a class="btn" href="enrollment.php">Cancel</a></div></form></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>