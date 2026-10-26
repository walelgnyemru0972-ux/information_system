<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/database.php';

$studentCount = (int)$pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
$courseCount = (int)$pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$enrollmentCount = (int)$pdo->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
$resultCount = (int)$pdo->query("SELECT COUNT(*) FROM results")->fetchColumn();

$recentStudents = $pdo->query("SELECT id, student_no, first_name, last_name, department, created_at FROM students ORDER BY id DESC LIMIT 5")->fetchAll();
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<?php include __DIR__ . '/includes/navbar.php'; ?>
<div class="layout">
    <?php include __DIR__ . '/includes/sidebar.php'; ?>
    <main class="content">
        <div class="page-heading">
            <div><h2>Dashboard</h2><p class="muted">Welcome, <?= htmlspecialchars($_SESSION['full_name']) ?>.</p></div>
        </div>

        <div class="cards">
            <div class="stat-card"><span>Students</span><strong><?= $studentCount ?></strong></div>
            <div class="stat-card"><span>Courses</span><strong><?= $courseCount ?></strong></div>
            <div class="stat-card"><span>Enrollments</span><strong><?= $enrollmentCount ?></strong></div>
            <div class="stat-card"><span>Results</span><strong><?= $resultCount ?></strong></div>
        </div>

        <section class="panel">
            <div class="panel-header"><h3>Recent Students</h3><a class="btn btn-primary" href="students/add_student.php">Add Student</a></div>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>Student No.</th><th>Name</th><th>Department</th><th>Created</th><th>Action</th></tr></thead>
                    <tbody>
                    <?php foreach ($recentStudents as $s): ?>
                        <tr>
                            <td><?= htmlspecialchars($s['student_no']) ?></td>
                            <td><?= htmlspecialchars($s['first_name'].' '.$s['last_name']) ?></td>
                            <td><?= htmlspecialchars($s['department']) ?></td>
                            <td><?= htmlspecialchars($s['created_at']) ?></td>
                            <td><a class="btn btn-sm" href="students/view_student.php?id=<?= $s['id'] ?>">View</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (!$recentStudents): ?><tr><td colspan="5" class="empty">No students found.</td></tr><?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>