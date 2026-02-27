<?php
use Portfolio\Database;

session_start();

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/../includes/' . $class . '.php';
    
    require_once $filepath;
});

$database = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $results = $database->query('SELECT * FROM users WHERE username = :username', ['username' => $username]);
    $user = $results[0] ?? null;

    $passwordMatches = $user && password_verify($password, $user['password']);

    if ($passwordMatches) {
        $_SESSION['logged_in_user'] = $user;
        header('Location: /Portfolio/cms_admin/dashboard.php');
        exit();
    } else {
        $_SESSION['error_messages'] = [];
        $_SESSION['error_messages']['login'] = 'Invalid username or password';
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="hidden">Login Page</h2>
        <form id="loginForm" method="POST" action="login.php">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <button type="submit" class="submit-btn">Sign In</button>
        </form>
</body>
</html>

