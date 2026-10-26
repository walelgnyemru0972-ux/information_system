<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$courses=$pdo->query("SELECT c.*,COUNT(e.id) enrollment_count FROM courses c LEFT JOIN enrollments e ON e.course_id=c.id GROUP BY c.id ORDER BY c.id DESC")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Courses</h2><a class="btn btn-primary" href="add_course.php">Add Course</a></div>
<div class="panel table-wrap"><table><thead><tr><th>Code</th><th>Course Name</th><th>Credit Hours</th><th>Department</th><th>Enrolled</th><th>Actions</th></tr></thead><tbody>
<?php foreach($courses as $c):?><tr><td><?=htmlspecialchars($c['course_code'])?></td><td><?=htmlspecialchars($c['course_name'])?></td><td><?=htmlspecialchars($c['credit_hours'])?></td><td><?=htmlspecialchars($c['department'])?></td><td><?=htmlspecialchars($c['enrollment_count'])?></td><td><a class="btn btn-sm" href="edit_course.php?id=<?=$c['id']?>">Edit</a> <a class="btn btn-sm btn-danger" data-confirm="Delete this course and related enrollments?" href="delete_course.php?id=<?=$c['id']?>">Delete</a></td></tr><?php endforeach;?>
</tbody></table></div></main></div><?php include __DIR__ . '/../includes/footer.php'; ?>