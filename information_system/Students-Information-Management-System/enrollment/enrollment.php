<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$rows=$pdo->query("SELECT e.*,s.student_no,s.first_name,s.last_name,c.course_code,c.course_name FROM enrollments e JOIN students s ON s.id=e.student_id JOIN courses c ON c.id=e.course_id ORDER BY e.id DESC")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Enrollment</h2><a class="btn btn-primary" href="add_enrollment.php">Add Enrollment</a></div>
<div class="panel table-wrap"><table><thead><tr><th>Student</th><th>Course</th><th>Semester</th><th>Academic Year</th><th>Enrolled</th><th>Action</th></tr></thead><tbody>
<?php foreach($rows as $r):?><tr><td><?=htmlspecialchars($r['student_no'].' - '.$r['first_name'].' '.$r['last_name'])?></td><td><?=htmlspecialchars($r['course_code'].' - '.$r['course_name'])?></td><td><?=htmlspecialchars($r['semester'])?></td><td><?=htmlspecialchars($r['academic_year'])?></td><td><?=htmlspecialchars($r['enrollment_date'])?></td><td><a class="btn btn-sm btn-danger" data-confirm="Delete enrollment?" href="delete_enrollment.php?id=<?=$r['id']?>">Delete</a></td></tr><?php endforeach;?>
<?php if(!$rows):?><tr><td colspan="6" class="empty">No enrollments found.</td></tr><?php endif;?></tbody></table></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>