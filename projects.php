<?php

session_start();

$dsn = 'mysql:host=localhost;dbname=portfolio';
$connection = new PDO($dsn, 'root', 'root');

$id = $_GET['projects_id'] ?? null;

if (!$id) {
    die("No project selected.");
}

$singlePStmt = $connection->prepare(
    'SELECT * FROM tbl_projects WHERE projects_id = :id'
);

$singlePStmt->bindParam(':id', $id, PDO::PARAM_INT);
$singlePStmt->execute();

$singleProjectResult = $singlePStmt->fetch(PDO::FETCH_ASSOC);

if (!$singleProjectResult) {
    die("Project not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?= $singleProjectResult['title']; ?></title>
    </head>
    <body>
        <section id="project-hero">

            <!-- HERO IMAGE -->
            <div class="project-hero-image">
                <?php if ($heroImage): ?>
                    <img src="images/<?= htmlspecialchars($heroImage); ?>" 
                        alt="<?= htmlspecialchars($singleProjectResult['title']); ?>">
                <?php endif; ?>
            </div>

            <!-- OVERVIEW -->
            <div id="overview-con">

                <div class="overview-header">
                    <span class="project-number">
                        <?= htmlspecialchars($singleProjectResult['projects_id']); ?>
                    </span>

                    <div class="title-block">
                        <h2><?= htmlspecialchars($singleProjectResult['title']); ?></h2>
                    </div>
                </div>

                <div class="overview-text">
                    <h3>Overview</h3>
                    <p><?= nl2br(htmlspecialchars($singleProjectResult['overview'])); ?></p>
                </div>

                <div class="overview-content">

                    <div class="overview-image">
                        <?php if ($overviewImage): ?>
                            <img src="images/<?= htmlspecialchars($overviewImage); ?>" 
                                alt="<?= htmlspecialchars($singleProjectResult['title']); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="overview-details">
                        <h3>Role</h3>
                        <p><?= htmlspecialchars($singleProjectResult['role']); ?></p>

                        <h3>Duration</h3>
                        <p><?= htmlspecialchars($singleProjectResult['duration']); ?></p>

                        <h3>Tools</h3>
                        <p><?= htmlspecialchars($singleProjectResult['tools_and_skills']); ?></p>
                    </div>

                </div>
            </div>

            <!-- PROCESS -->
            <div id="process-con">
                <h3>The Process</h3>
                <p><?= nl2br(htmlspecialchars($singleProjectResult['process'])); ?></p>
            </div>

            <!-- IMPACT & Outcomes -->
            <div id="solution-con">
                <h3>Impact & Outcomes</h3>
                <p><?= nl2br(htmlspecialchars($singleProjectResult['impact_and_outcomes'])); ?></p>
            </div>

        </section>
    </body>
</html>