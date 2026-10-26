<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$q=trim($_GET['q']??'');
if($q!==''){ $stmt=$pdo->prepare("SELECT * FROM students WHERE student_no LIKE ? OR first_name LIKE ? OR last_name LIKE ? OR department LIKE ? ORDER BY id DESC"); $like="%$q%"; $stmt->execute([$like,$like,$like,$like]); $students=$stmt->fetchAll(); }
else $students=$pdo->query("SELECT * FROM students ORDER BY id DESC")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Students</h2><a class="btn btn-primary" href="add_student.php">Add Student</a></div>
<form class="searchbar"><input name="q" value="<?=htmlspecialchars($q)?>" placeholder="Search students..."><button class="btn">Search</button></form>
<div class="panel table-wrap"><table><thead><tr><th>Student No.</th><th>Name</th><th>Gender</th><th>Department</th><th>Year</th><th>Actions</th></tr></thead><tbody>
<?php foreach($students as $s): ?><tr><td><?=htmlspecialchars($s['student_no'])?></td><td><?=htmlspecialchars($s['first_name'].' '.$s['last_name'])?></td><td><?=htmlspecialchars($s['gender'])?></td><td><?=htmlspecialchars($s['department'])?></td><td><?=htmlspecialchars($s['year_level'])?></td>
<td><a class="btn btn-sm" href="view_student.php?id=<?=$s['id']?>">View</a> <a class="btn btn-sm" href="edit_student.php?id=<?=$s['id']?>">Edit</a> <a class="btn btn-sm btn-danger" data-confirm="Delete this student and related records?" href="delete_student.php?id=<?=$s['id']?>">Delete</a></td></tr><?php endforeach; ?>
<?php if(!$students): ?><tr><td colspan="6" class="empty">No students found.</td></tr><?php endif; ?></tbody></table></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>