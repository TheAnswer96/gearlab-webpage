<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Home Page</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body class="home-page">

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<section class="home-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 hero-content">
                <p class="hero-eyebrow">University of Perugia</p>
                <h1>Algorithms for emerging models in networks, UAV systems, and optimization.</h1>
                <p class="hero-text">
                    GEAR Lab designs rigorous algorithmic methods for practical and high-impact scenarios, from urban
                    drone routing to resilient communication systems.
                </p>
                <div class="hero-actions">
                    <a href="publications.php" class="btn btn-primary">Explore Publications</a>
                    <a href="projects.php" class="btn btn-outline-light">View Grants</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrap">
                    <img src="images/home/image2.jpg" alt="GEAR Lab activity" class="hero-image">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="snapshot-section">
    <div class="container">
        <div class="snapshot-grid">
            <div class="snapshot-card">
                <span class="snapshot-number">5+</span>
                <span class="snapshot-label">Research Areas</span>
            </div>
            <div class="snapshot-card">
                <span class="snapshot-number">3</span>
                <span class="snapshot-label">Funded Projects</span>
            </div>
            <div class="snapshot-card">
                <span class="snapshot-number">20+</span>
                <span class="snapshot-label">Recent Publications</span>
            </div>
            <div class="snapshot-card">
                <span class="snapshot-number">10+</span>
                <span class="snapshot-label">Researchers & Collaborators</span>
            </div>
        </div>
    </div>
</section>

<section class="news-section">
    <div class="container">
        <div class="section-heading">
            <h2>Highlights</h2>
            <p>Research milestones and lab updates.</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <article class="news-card">
                    <img src="images/post-icon/trophy.png" alt="Award icon">
                    <h3>BREADCRUMBS Project Milestone</h3>
                    <p class="news-meta">February 2026</p>
                    <p>New results on connectivity-aware and risk-aware UAV route planning in urban BVLOS scenarios.</p>
                </article>
            </div>
            <div class="col-md-4 mb-4">
                <article class="news-card">
                    <img src="images/post-icon/certificate.png" alt="Publication icon">
                    <h3>Publications Updated</h3>
                    <p class="news-meta">2026</p>
                    <p>The publications list now loads directly from DBLP and is continuously aligned with current output.</p>
                </article>
            </div>
            <div class="col-md-4 mb-4">
                <article class="news-card">
                    <img src="images/post-icon/computer.png" alt="Team icon">
                    <h3>Team and Collaborator Updates</h3>
                    <p class="news-meta">2026</p>
                    <p>The team page reflects current positions and external collaborations across partner institutions.</p>
                </article>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
