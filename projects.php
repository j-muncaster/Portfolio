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

// This section is fetching the project data :
$projectStmt->bindParam(':id', $id);
$projectStmt->execute();
$project = $projectStmt->fetch(PDO::FETCH_ASSOC);

if (!$project) {
    die("Project not found.");
}

// This section is fetching the associated images for the project :
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
    if ($image['type'] === 'hero') {
        $heroImage = $image;
    }

    if ($image['type'] === 'project') {
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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollToPlugin.min.js"></script>
    <script type="module" src="js/main.js"></script>
</head>

<body data-page="project">

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
        <img src="images/<?= htmlspecialchars($heroImage['image_lg']); ?>" 
             alt="<?= htmlspecialchars($project['title']); ?>">
    </div>
<?php endif; ?>

</section>

<section id="project-content">

    <div class="project-title">
        <h1><?= htmlspecialchars($project['title']); ?></h1>
    </div>

    <!-- nl2br allows for line breaks to be maintained from the database into HTML so they aren't ignored -->
    <div class="overview-section">
        <h2>Overview</h2>
        <p><?= nl2br(htmlspecialchars($project['overview'])); ?></p>
    </div>

    <div class="project-meta">

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

<section id="project-gallery">

<?php foreach ($galleryImages as $image): ?>

    <div class="gallery-item">
        <img src="images/<?= htmlspecialchars($image['image_lg']); ?>" 
             alt="<?= htmlspecialchars($project['title']); ?>">
    </div>

<?php endforeach; ?>

</section>

<section id="process-section">

    <h2>The Process</h2>
    <p><?= nl2br(htmlspecialchars($project['process'])); ?></p>

</section>

<section id="impact-section">

    <h2>Impact & Outcomes</h2>
    <p><?= nl2br(htmlspecialchars($project['impact_and_outcomes'])); ?></p>

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
            <a href="about.html">About</a> <a href="contact.html">Contact</a> 
        </nav> 
        
        <div id="footer-icons" class="col-span-full"> 
            <a href="https://www.instagram.com/jo.muncaster/" target="_blank"> 
                <img src="images/instagram_icon.png" alt="Instagram"> 
            </a> 
            <a href="https://github.com/j-muncaster" target="_blank"> 
                <img src="images/github_logo.png" alt="GitHub"></a> 
                <a href="https://www.linkedin.com/in/josephine-muncaster-382674135/" target="_blank"> 
                    <img src="images/linkedin_logo.png" alt="LinkedIn"></a> 
                </div>
                <div id="footer-privacy" class="col-span-full"> 
                    <p>© All Rights Reserved 2025 | Jo Muncaster</p> 
                </div> 
            </div> 
        </footer>
</body>
</html>