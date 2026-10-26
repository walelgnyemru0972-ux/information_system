<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$students=$pdo->query("SELECT s.*,COUNT(DISTINCT e.id) enrollments FROM students s LEFT JOIN enrollments e ON e.student_id=s.id GROUP BY s.id ORDER BY s.department,s.student_no")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Student Report</h2><button class="btn" onclick="window.print()">Print</button></div>
<div class="panel table-wrap"><table><thead><tr><th>Student No.</th><th>Name</th><th>Department</th><th>Year</th><th>Gender</th><th>Enrollments</th></tr></thead><tbody><?php foreach($students as $s):?><tr><td><?=htmlspecialchars($s['student_no'])?></td><td><?=htmlspecialchars($s['first_name'].' '.$s['last_name'])?></td><td><?=htmlspecialchars($s['department'])?></td><td><?=htmlspecialchars($s['year_level'])?></td><td><?=htmlspecialchars($s['gender'])?></td><td><?=htmlspecialchars($s['enrollments'])?></td></tr><?php endforeach;?></tbody></table></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>