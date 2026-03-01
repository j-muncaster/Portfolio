<?php
session_start();

// This section is only accessible by users that can log in and this ensures that :
if (!isset($_SESSION['logged_in_user'])) {
    header('Location: login.php');
    exit();
}

use Portfolio\Database;

// This section connects to the database :
spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';

    if (file_exists($filepath)) {
        require_once $filepath;
    }
});

$database = new Database();

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: dashboard.php');
    exit();
}

// This section fetches the project data :
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database->query(
        "UPDATE tbl_projects SET
            title = :title,
            overview = :overview,
            duration = :duration,
            tools_and_skills = :tools_and_skills,
            role = :role,
            process = :process,
            impact_and_outcomes = :impact_and_outcomes
        WHERE projects_id = :id",
        [
            'title' => $_POST['title'] ?? '',
            'overview' => $_POST['overview'] ?? '',
            'duration' => $_POST['duration'] ?? '',
            'tools_and_skills' => $_POST['tools_and_skills'] ?? '',
            'role' => $_POST['role'] ?? '',
            'process' => $_POST['process'] ?? '',
            'impact_and_outcomes' => $_POST['impact_and_outcomes'] ?? '',
            'id' => $id
        ]
    );

    header('Location: dashboard.php');
    exit();
}

$result = $database->query(
    "SELECT * FROM tbl_projects WHERE projects_id = :id",
    ['id' => $id]
);

$project = $result[0] ?? null;

if (!$project) {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/grid.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">
    <title>Edit Project | CMS</title>
</head>

<body data-page="about">

<header id="main-nav" class="inner-header">
    <div class="nav-left">
        <a href="dashboard.php" class="brand">
            <img src="../images/letter_j_white.svg" alt="J Logo">
            <span>MUNCASTER</span>
        </a>
    </div>

    <nav class="nav-links dashboard-nav">
        <a href="dashboard.php" class="header-btn">Back to Dashboard</a>
        <a href="logout.php" class="header-btn logout-btn">Logout</a>
    </nav>
</header>

<section id="about" class="col-span-full">
    <div class="background-layer"></div>

    <div class="grid-con">
        <h3>Edit Project</h3>

        <form method="POST" class="dashboard-form">
            
            <!-- This send the form data using POST -->
            <label>Title</label>
            <input type="text" name="title"
                   value="<?= htmlspecialchars($project['title']); ?>" required>

            <label>Overview</label>
            <textarea name="overview" rows="4" required><?= htmlspecialchars($project['overview']); ?></textarea>

            <label>Duration</label>
            <input type="text" name="duration"
                   value="<?= htmlspecialchars($project['duration']); ?>">

            <label>Tools & Skills</label>
            <input type="text" name="tools_and_skills"
                   value="<?= htmlspecialchars($project['tools_and_skills']); ?>">

            <label>Role</label>
            <input type="text" name="role"
                   value="<?= htmlspecialchars($project['role']); ?>">

            <label>Process</label>
            <textarea name="process" rows="4"><?= htmlspecialchars($project['process']); ?></textarea>

            <label>Impact & Outcomes</label>
            <textarea name="impact_and_outcomes" rows="4"><?= htmlspecialchars($project['impact_and_outcomes']); ?></textarea>

            <button type="submit" class="button">
                Update Project
            </button>

        </form>
    </div>
</section>

</body>
</html>