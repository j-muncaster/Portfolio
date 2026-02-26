<?php
session_start();

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class); # needed for both
    $filepath = __DIR__ . '/../../includes/classes/' . $class . '.php';
    
    require_once $filepath;
});

use Portfolio\Database;

$database = new Database();

$username = $_POST['username'];
$password = $_POST['password'];

$results = $database->query('SELECT * FROM users WHERE username = :username', ['username' => $username]);
$user = $results[0] ?? null;

$passwordMatches = password_verify($password, $user['password']);

if ($passwordMatches) {
    $_SESSION['logged_in_user'] = $user;
    header('Location: /dashboard.php');
    exit;
} else {
    // set some error messages
    $_SESSION['error_messages'] = [];
    $_SESSION['error_messages']['login'] = "error $password";
    header('Location: /Portfolio/login.php');
    exit;
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
        <form id="contactForm" method="POST" action="login.php">
            <label for="username">Username</label>
            <input id="username" name="username" type="text" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="text" required>

            <button type="submit" class="submit-btn">Sign In</button>
        </form>
</body>
</html>

<?php
$_SESSION['error_messages'] = [];
$_SESSION['error_messages']['login']= "error!";
header('Location: login.php');
?>