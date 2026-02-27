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

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: dashboard.php');
    exit();
}

// Delete the project
$database->query(
    "DELETE FROM tbl_projects WHERE projects_id = :id",
    ['id' => $id]
);

// Redirect back
header('Location: dashboard.php');
exit();