<aside class="sidebar">
    <nav>
        <a href="/Students-Information-Management-System/dashboard.php">Dashboard</a>
        <a href="/Students-Information-Management-System/students/students.php">Students</a>
        <a href="/Students-Information-Management-System/courses/courses.php">Courses</a>
        <a href="/Students-Information-Management-System/enrollment/enrollment.php">Enrollment</a>
        <a href="/Students-Information-Management-System/results/results.php">Results</a>
        <a href="/Students-Information-Management-System/reports/student_report.php">Student Report</a>
        <a href="/Students-Information-Management-System/reports/result_report.php">Result Report</a>
        <a href="/Students-Information-Management-System/reports/course_report.php">Course Report</a>
        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>
            <a href="/Students-Information-Management-System/admin/dashboard.php">Admin</a>
        <?php endif; ?>
    </nav>
</aside>