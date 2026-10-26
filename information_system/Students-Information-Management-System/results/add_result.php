<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$enrollments=$pdo->query("SELECT e.id,s.student_no,s.first_name,s.last_name,c.course_code,c.course_name,e.semester,e.academic_year FROM enrollments e JOIN students s ON s.id=e.student_id JOIN courses c ON c.id=e.course_id ORDER BY s.student_no,c.course_code")->fetchAll();$error='';
function calculateGrade($score){if($score>=90)return'A+';if($score>=85)return'A';if($score>=80)return'B+';if($score>=75)return'B';if($score>=70)return'C+';if($score>=60)return'C';if($score>=50)return'D';return'F';}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $eid=(int)($_POST['enrollment_id']??0);$score=(float)($_POST['score']??-1);$remarks=trim($_POST['remarks']??'');
 if(!$eid||$score<0||$score>100)$error='Select an enrollment and enter a score from 0 to 100.';
 else{$grade=calculateGrade($score);try{$stmt=$pdo->prepare("INSERT INTO results(enrollment_id,score,grade,remarks) VALUES(?,?,?,?)");$stmt->execute([$eid,$score,$grade,$remarks]);header("Location: results.php");exit;}catch(PDOException $e){$error='A result already exists for this enrollment.';}}
}
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Add Result</h2></div><?php if($error):?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif;?>
<div class="panel"><form method="post" class="form-grid"><label class="full">Enrollment<select name="enrollment_id" required><option value="">Select enrollment</option><?php foreach($enrollments as $e):?><option value="<?=$e['id']?>"><?=htmlspecialchars($e['student_no'].' - '.$e['first_name'].' '.$e['last_name'].' | '.$e['course_code'].' | '.$e['semester'].' '.$e['academic_year'])?></option><?php endforeach;?></select></label>
<label>Score (0-100)<input type="number" name="score" min="0" max="100" step="0.01" required></label><label class="full">Remarks<textarea name="remarks" rows="3"></textarea></label>
<div><button class="btn btn-primary">Save Result</button> <a class="btn" href="results.php">Cancel</a></div></form></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>