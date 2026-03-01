<?php
session_start();

// This section is only accessible by users that can log in and this ensures that :
if (!isset($_SESSION['logged_in_user'])) {
    header('Location: login.php');
    exit();
}

use Portfolio\Database;

// This section establishes the database connection :
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

// Delete the project :
$database->query(
    "DELETE FROM tbl_projects WHERE projects_id = :id",
    ['id' => $id]
);

// Redirect back to the dashboard after deletion :
header('Location: dashboard.php');
exit();