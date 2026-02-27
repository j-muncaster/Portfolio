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

    $results = $database->query('SELECT * FROM tbl_user WHERE username = :username', ['username' => $username]);
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

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../images/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="../images/favicon.svg" />
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png" />
    <link rel="manifest" href="../images/site.webmanifest" />

    <!-- CSS -->
    <link href="../css/grid.css" rel="stylesheet">
    <link href="../css/main.css" rel="stylesheet">

    <title>CMS Login | Josephine Muncaster</title>
</head>

<body data-page="about">

<header id="main-nav" class="inner-header">

    <div class="nav-left">
        <a href="../index.php" class="brand">
            <img src="../images/letter_j_white.svg" alt="J Logo">
            <span>MUNCASTER</span>
        </a>
    </div>

</header>

<section id="about" class="col-span-full">

    <div class="grid-con">
        <h3>CMS Dashboard Login</h3>

        <p style="margin-bottom: 30px; text-align: center;">
            This is your private content management portal.<br>  
            Sign in to manage projects and update your portfolio.
        </p>

        <?php if (!empty($_SESSION['error_messages']['login'])): ?>
            <p style="color:#cc0000; margin-bottom:20px;">
                <?= $_SESSION['error_messages']['login']; ?>
            </p>
            <?php unset($_SESSION['error_messages']); ?>
        <?php endif; ?>

        <form method="POST" action="login.php" style="max-width:400px;">

            <label for="username">Username</label>
            <input id="username" name="username" type="text" required>

            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>

            <button type="submit" class="button" style="margin-top:20px;">
                Sign In
            </button>

        </form>
    </div>
</section>

</body>
</html>