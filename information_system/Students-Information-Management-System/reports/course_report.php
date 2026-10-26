<?php
require_once __DIR__ . '/../includes/auth.php'; require_once __DIR__ . '/../config/database.php';
$rows=$pdo->query("SELECT c.course_code,c.course_name,c.department,c.credit_hours,COUNT(e.id) enrollments,AVG(r.score) avg_score FROM courses c LEFT JOIN enrollments e ON e.course_id=c.id LEFT JOIN results r ON r.enrollment_id=e.id GROUP BY c.id ORDER BY c.department,c.course_code")->fetchAll();
?>
<?php include __DIR__ . '/../includes/header.php'; include __DIR__ . '/../includes/navbar.php'; ?><div class="layout"><?php include __DIR__ . '/../includes/sidebar.php'; ?><main class="content">
<div class="page-heading"><h2>Course Report</h2><button class="btn" onclick="window.print()">Print</button></div>
<div class="panel table-wrap"><table><thead><tr><th>Code</th><th>Course</th><th>Department</th><th>Credits</th><th>Enrollments</th><th>Average Score</th></tr></thead><tbody><?php foreach($rows as $r):?><tr><td><?=htmlspecialchars($r['course_code'])?></td><td><?=htmlspecialchars($r['course_name'])?></td><td><?=htmlspecialchars($r['department'])?></td><td><?=htmlspecialchars($r['credit_hours'])?></td><td><?=htmlspecialchars($r['enrollments'])?></td><td><?= $r['avg_score'] !== null ? number_format((float)$r['avg_score'],2) : '—' ?></td></tr><?php endforeach;?></tbody></table></div>
</main></div><?php include __DIR__ . '/../includes/footer.php'; ?>