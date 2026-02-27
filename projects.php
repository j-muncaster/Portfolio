<?php

session_start();

use Portfolio\Database;

spl_autoload_register(function ($class) {
    $class = str_replace('Portfolio\\', '', $class);
    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);
    $filepath = __DIR__ . '/includes/classes/' . $class . '.php';
    
    require_once $filepath;
});

require_once 'includes/database.php';
$config = getConfig();
$dsn = 'mysql:host=localhost;dbname=portfolio;';
$connection = new PDO($dsn, 'root', '');
// this is the preferred way you should use PDO
// http://localhost/weekthree/project.php?id=1
$id = $_GET['id'];
$singlePStmt = $connection->prepare(
    'SELECT * FROM projects WHERE id = :id;'
);
$singlePStmt->bindParam(':id', $id, PDO::PARAM_INT);
$singlePStmt->execute();
$singleProjectResult = $singlePStmt->fetch(PDO::FETCH_ASSOC);

var_dump($singleProjectResult);

$categoryStmt = $connection->prepare(
    'SELECT * FROM categories WHERE id = :id'
);
$categoryStmt->bindParam(
    ':id', 
    $singleProjectResult['category_id'],
    PDO::PARAM_INT
);
$categoryStmt->execute();
$category = $categoryStmt->fetch(PDO::FETCH_ASSOC);
var_dump($category);
?>

<!DOCTYPE html>
<html lang="en">
    <body>
        <h1><?php echo $singleProjectResult['title']; ?></h1>
        <p><?php echo $singleProjectResult['description']; ?></p>
    </body>
</html>