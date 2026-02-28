<?php
session_start();

$dsn = 'mysql:host=localhost;dbname=portfolio';
$connection = new PDO($dsn, 'root', 'root');

$id = $_GET['projects_id'] ?? null;

if (!$id) {
    die("No project selected.");
}

$projectStmt = $connection->prepare("
    SELECT * FROM tbl_projects 
    WHERE projects_id = :id
");

$projectStmt->bindParam(':id', $id);
$projectStmt->execute();

$project = $projectStmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    die("Project not found.");
}

$imageStmt = $connection->prepare("
    SELECT * FROM tbl_images
    WHERE projects_id = :id
");

$imageStmt->bindParam(':id', $id);
$imageStmt->execute();

$projectImages = $imageStmt->fetchAll(PDO::FETCH_ASSOC);

$heroImage = null;
$galleryImages = [];

foreach ($projectImages as $image) {
    if ($image['image_type'] === 'hero') {
        $heroImage = $image;
    } else {
        $galleryImages[] = $image;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($project['title']); ?></title>
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

<header id="main-nav" class="inner-header">

    <div class="nav-left">
        <a href="index.php" class="brand">
            <img src="images/letter_j_white.svg" alt="J Logo">
            <span>MUNCASTER</span>
        </a>
    </div>

    <nav class="nav-links">
        <a href="index.php#project-scroll">Projects</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </nav>

    <button id="inner-hamburger">
        <img src="images/hamburger_menu.png" alt="Menu">
    </button>

    <div id="inner-mobile-menu">
        <a href="index.php#project-scroll">Projects</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>
    </div>

</header>

<section id="project-hero">

<?php if ($heroImage): ?>
    <div class="project-hero-image">
        <picture>
            <source media="(min-width: 768px)" 
                    srcset="images/<?= htmlspecialchars($heroImage['image_lg']); ?>">
            <img src="images/<?= htmlspecialchars($heroImage['image_sm']); ?>" 
                 alt="<?= htmlspecialchars($project['title']); ?>">
        </picture>
    </div>
<?php endif; ?>

</section>

<section id="project-content" class="grid-con">

    <div class="col-span-full project-title">
        <h1><?= htmlspecialchars($project['title']); ?></h1>
    </div>

    <div class="col-span-full overview-section">
        <h2>Overview</h2>
        <p><?= nl2br(htmlspecialchars($project['overview'])); ?></p>
    </div>

    <div class="col-span-full project-meta">

        <div class="meta-item">
            <h3>Duration</h3>
            <p><?= htmlspecialchars($project['duration']); ?></p>
        </div>

        <div class="meta-item">
            <h3>Tools & Skills</h3>
            <p><?= htmlspecialchars($project['tools_and_skills']); ?></p>
        </div>

        <div class="meta-item">
            <h3>Role</h3>
            <p><?= htmlspecialchars($project['role']); ?></p>
        </div>

    </div>

</section>

<section id="project-gallery" class="grid-con">

<?php 
$count = 0;
foreach ($projectImages as $image): 
    if ($count >= 4) break;
?>

    <div class="gallery-item col-span-6">
        <picture>
            <source media="(min-width: 768px)" 
                    srcset="images/<?= htmlspecialchars($image['image_lg']); ?>">
            <img src="images/<?= htmlspecialchars($image['image_sm']); ?>" 
                 alt="<?= htmlspecialchars($project['title']); ?>">
        </picture>
    </div>

<?php 
$count++;
endforeach; 
?>

</section>

<section id="process-section" class="grid-con">

    <div class="col-span-full">
        <h2>The Process</h2>
        <p><?= nl2br(htmlspecialchars($project['process'])); ?></p>
    </div>

</section>

<section id="impact-section" class="grid-con">

    <div class="col-span-full">
        <h2>Impact & Outcomes</h2>
        <p><?= nl2br(htmlspecialchars($project['impact_and_outcomes'])); ?></p>
    </div>

</section>

<footer id="footer-hero">
    <div class="grid-con">

        <div id="footer-logo" class="col-span-full">
            <a href="index.php">
                <img src="images/letter_j_orange.svg" alt="Orange Logo">
            </a>
        </div>

        <nav id="footer-nav" class="col-span-full">
            <a href="index.php#project-scroll">Projects</a>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
        </nav>

        <div id="footer-icons" class="col-span-full">
            <a href="https://www.instagram.com/jo.muncaster/" target="_blank">
                <img src="images/instagram_icon.png" alt="Instagram">
            </a>
            <a href="https://github.com/j-muncaster" target="_blank">
                <img src="images/github_logo.png" alt="GitHub">
            </a>
            <a href="https://www.linkedin.com/in/josephine-muncaster-382674135/" target="_blank">
                <img src="images/linkedin_logo.png" alt="LinkedIn">
            </a>
        </div>

        <div id="footer-privacy" class="col-span-full">
            <p>© All Rights Reserved 2025 | Jo Muncaster</p>
        </div>

    </div>
</footer>

</body>
</html>