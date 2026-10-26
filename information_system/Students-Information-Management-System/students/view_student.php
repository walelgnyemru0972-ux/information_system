<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$id=(int)($_GET['id']??0);$stmt=$pdo->prepare("SELECT * FROM students WHERE id=?");$stmt->execute([$id]);$s=$stmt->fetch();if(!$s){header("Location: students.php");exit;}
$stmt=$pdo->prepare("SELECT c.course_code,c.course_name,e.semester,e.academic_year,r.score,r.grade FROM enrollments e JOIN courses c ON c.id=e.course_id LEFT JOIN results r ON r.enrollment_id=e.id WHERE e.student_id=? ORDER BY e.id DESC");$stmt->execute([$id]);$records=$stmt->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Student Profile</h2><div><a class="btn" href="students.php">Back</a> <a class="btn btn-primary" href="edit_student.php?id=<?=$id?>">Edit</a></div></div>
<div class="panel profile-grid">
<div><strong>Student Number</strong><span><?=htmlspecialchars($s['student_no'])?></span></div><div><strong>Name</strong><span><?=htmlspecialchars($s['first_name'].' '.$s['last_name'])?></span></div>
<div><strong>Gender</strong><span><?=htmlspecialchars($s['gender'])?></span></div><div><strong>Date of Birth</strong><span><?=htmlspecialchars($s['date_of_birth']??'')?></span></div>
<div><strong>Phone</strong><span><?=htmlspecialchars($s['phone']??'')?></span></div><div><strong>Email</strong><span><?=htmlspecialchars($s['email']??'')?></span></div>
<div><strong>Department</strong><span><?=htmlspecialchars($s['department'])?></span></div><div><strong>Year</strong><span><?=htmlspecialchars($s['year_level'])?></span></div>
<div class="full"><strong>Address</strong><span><?=nl2br(htmlspecialchars($s['address']??''))?></span></div>
</div>
<section class="panel"><div class="panel-header"><h3>Academic Records</h3></div><div class="table-wrap"><table><thead><tr><th>Course</th><th>Semester</th><th>Academic Year</th><th>Score</th><th>Grade</th></tr></thead><tbody>
<?php foreach($records as $r):?><tr><td><?=htmlspecialchars($r['course_code'].' - '.$r['course_name'])?></td><td><?=htmlspecialchars($r['semester'])?></td><td><?=htmlspecialchars($r['academic_year'])?></td><td><?=htmlspecialchars($r['score']??'')?></td><td><?=htmlspecialchars($r['grade']??'')?></td></tr><?php endforeach;?>
<?php if(!$records):?><tr><td colspan="5" class="empty">No academic records.</td></tr><?php endif;?></tbody></table></div></section>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>