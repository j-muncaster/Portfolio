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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $database->query(
            "INSERT INTO tbl_projects 
            (title, overview, duration, tools_and_skills, role, process, impact_and_outcomes)
            VALUES 
            (:title, :overview, :duration, :tools_and_skills, :role, :process, :impact_and_outcomes)",
            [
                'title' => $_POST['title'] ?? '',
                'overview' => $_POST['overview'] ?? '',
                'duration' => $_POST['duration'] ?? '',
                'tools_and_skills' => $_POST['tools_and_skills'] ?? '',
                'role' => $_POST['role'] ?? '',
                'process' => $_POST['process'] ?? '',
                'impact_and_outcomes' => $_POST['impact_and_outcomes'] ?? ''
            ]
        );

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
        <title>Create Project | CMS</title>
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

        <div class="grid-con">
            <h3>Create New Project</h3>

            <form method="POST" class="dashboard-form">

                <label>Title</label>
                <input type="text" name="title" required>

                <label>Overview</label>
                <textarea name="overview" rows="4" required></textarea>

                <label>Duration</label>
                <input type="text" name="duration">

                <label>Tools & Skills</label>
                <input type="text" name="tools_and_skills">

                <label>Role</label>
                <input type="text" name="role">

                <label>Process</label>
                <textarea name="process" rows="4"></textarea>

                <label>Impact & Outcomes</label>
                <textarea name="impact_and_outcomes" rows="4"></textarea>

                <button type="submit" class="button">
                    Save Project
                </button>

            </form>
        </div>
    </section>

    </body>
    </html>