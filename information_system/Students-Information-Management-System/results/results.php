<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$rows=$pdo->query("SELECT r.*,s.student_no,s.first_name,s.last_name,c.course_code,c.course_name FROM results r JOIN enrollments e ON e.id=r.enrollment_id JOIN students s ON s.id=e.student_id JOIN courses c ON c.id=e.course_id ORDER BY r.id DESC")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Results</h2><a class="btn btn-primary" href="add_result.php">Add Result</a></div>
<div class="panel table-wrap"><table><thead><tr><th>Student</th><th>Course</th><th>Score</th><th>Grade</th><th>Remarks</th><th>Actions</th></tr></thead><tbody>
<?php foreach($rows as $r):?><tr><td><?=htmlspecialchars($r['student_no'].' - '.$r['first_name'].' '.$r['last_name'])?></td><td><?=htmlspecialchars($r['course_code'].' - '.$r['course_name'])?></td><td><?=htmlspecialchars($r['score'])?></td><td><strong><?=htmlspecialchars($r['grade'])?></strong></td><td><?=htmlspecialchars($r['remarks']??'')?></td><td><a class="btn btn-sm" href="edit_result.php?id=<?=$r['id']?>">Edit</a> <a class="btn btn-sm btn-danger" data-confirm="Delete result?" href="delete_result.php?id=<?=$r['id']?>">Delete</a></td></tr><?php endforeach;?>
<?php if(!$rows):?><tr><td colspan="6" class="empty">No results found.</td></tr><?php endif;?></tbody></table></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>