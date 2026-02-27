<?php
session_start();

if (!isset($_SESSION['logged_in_user'])) {
    header('Location: login.php');
    exit();
}

use Portfolio\Database;

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';

    if (file_exists($filepath)) {
        require_once $filepath;
    }
});

$database = new Database();

$projects = $database->query(
    "SELECT * FROM tbl_projects ORDER BY projects_id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../css/grid.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">

    <title>Dashboard | Jo Muncaster</title>
</head>

<body data-page="about">

<header id="main-nav" class="inner-header">

    <div class="nav-left">
        <a href="../index.php" class="brand">
            <img src="../images/letter_j_white.svg" alt="J Logo">
            <span>MUNCASTER</span>
        </a>
    </div>

    <nav class="nav-links dashboard-nav">
        <a href="create.php" class="header-btn add-btn">+ Add Project</a>
        <a href="logout.php" class="header-btn logout-btn">Logout</a>
    </nav>

</header>

<section id="about" class="col-span-full">

    <div class="grid-con">

        <div class="dashboard-topbar">
            <h3>CMS Portfolio Dashboard</h3>
        </div>
    </div>

        <?php if (empty($projects)): ?>
            <p>No projects found.</p>
        <?php else: ?>

        <div class="dashboard-wrapper">
            <table class="dashboard-table">

                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Overview</th>
                    <th>Duration</th>
                    <th>Tools & Skills</th>
                    <th>Role</th>
                    <th>Process</th>
                    <th>Impact & Outcomes</th>
                    <th>Actions</th>
                </tr>

                <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?= (int)$project['projects_id']; ?></td>
                    <td><?= htmlspecialchars($project['title']); ?></td>
                    <td><?= htmlspecialchars($project['overview']); ?></td>
                    <td><?= htmlspecialchars($project['duration']); ?></td>
                    <td><?= htmlspecialchars($project['tools_and_skills']); ?></td>
                    <td><?= htmlspecialchars($project['role']); ?></td>
                    <td><?= htmlspecialchars($project['process']); ?></td>
                    <td><?= htmlspecialchars($project['impact_and_outcomes']); ?></td>
                    <td class="dashboard-actions">
                        <a href="edit.php?id=<?= (int)$project['projects_id']; ?>">Edit</a>
                        <a href="delete.php?id=<?= (int)$project['projects_id']; ?>"
                           onclick="return confirm('Are you sure?');">
                           Delete
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>

        <?php endif; ?>
</section>

</body>
</html>