<header class="topbar">
    <div class="brand"><a href="/Students-Information-Management-System/dashboard.php">SIMS</a></div>
    <div class="topbar-right">
        <span><?= htmlspecialchars($_SESSION['full_name'] ?? '') ?> (<?= htmlspecialchars($_SESSION['role'] ?? '') ?>)</span>
        <a class="btn btn-sm btn-light" href="/Students-Information-Management-System/logout.php">Logout</a>
    </div>
</header>