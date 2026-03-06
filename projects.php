<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Funded Projects</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>
<body class="projects-page">

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<section class="projects-hero">
    <div class="container">
        <p class="projects-eyebrow">GEAR Lab</p>
        <h1>Funded Projects</h1>
        <p class="projects-subtitle">Competitive grants supporting algorithmic research in UAV systems, optimization, and data-driven monitoring.</p>
    </div>
</section>

<section class="projects-section">
    <div class="container">
        <div class="projects-grid">
            <article class="project-card">
                <div class="project-image-wrap">
                    <img src="images/projects/bvlos.png" alt="BREADCRUMBS project" class="project-image">
                </div>
                <div class="project-content">
                    <h2>BREADCRUMBS</h2>
                    <h3>Building up Robust and Efficient routing Algorithms for Drones by integrating Connectivity and Risk awareness in an Urban air Mobility Bvlos Scenario</h3>
                    <p class="project-period">Nov 2024 - Feb 2026</p>
                    <p>In this project, we propose to plan BVLoS UAVs flights by focusing on a few key missions as follows: i) suburban missions: UAVs are used for collecting images/data or for performing aerial work such as spraying on agriculture or monitoring corridors like rivers, electricity, and gas pipelines; and ii) urban missions: UAVs are used for structural health monitoring of buildings, traffic monitoring, food/beverage, small parcel mail, or biomedical goods delivery. In suburban missions, we will i) analyze the link quality and constraints offered by the cellular networks; ii) analyze the risk of UAVs; and iii) propose routing algorithms that consider both connectivity and risk assessment processes. In urban missions, we will i) optimize the Quality of Service (QoS) of the communications; ii) evaluate the security and safety robustness; and iii) devise advanced UAV routing and scheduling algorithms extended also to multiple UAVs.</p>
                    <a href="https://github.com/breadcrumbsprin2022pnrr/" target="_blank" class="project-link">More</a>
                </div>
            </article>

            <article class="project-card">
                <div class="project-image-wrap">
                    <img src="images/projects/haly.png" alt="Haly.ID project" class="project-image">
                </div>
                <div class="project-content">
                    <h2>Haly.ID</h2>
                    <h3>HALYomorpha halys IDentification: Innovative ICT tools for targeted monitoring and sustainable management of the brown marmorated stink bug and other pests</h3>
                    <p class="project-period">Feb 2021 - July 2024</p>
                    <p>The aims of the project are: (a) the design and implementation of an autonomous innovative data acquisition system in-field to detect HH and other pests as well, (b) the design and implement a classification system to detect fruits damages not visible at naked eye, (c) a software solution, based on ML techniques, to derive as furthest as we can the epidemiological model of HH or/and other pests, and (d) a logbook available to further steps of the fruit production chain.</p>
                    <a href="https://www.haly-id.eu" target="_blank" class="project-link">More</a>
                </div>
            </article>

            <article class="project-card">
                <div class="project-image-wrap">
                    <img src="images/projects/geo.jpg" alt="GEO-SAFE project" class="project-image">
                </div>
                <div class="project-content">
                    <h2>GEO-SAFE</h2>
                    <h3>Geospatial Based Environment For Optimisation Systems Addressing Fire Emergencies</h3>
                    <p class="project-period">May 2016 - April 2020</p>
                    <p>The GEO-SAFE project aims at creating a network enabling the two regions to exchange knowledge, ideas and experience, thus boosting the progress of wildfires knowledge and the related development of innovative methods for dealing efficiently with such fires. More precisely, the GEO-SAFE project focuses on developing the tools enabling to set up an integrated decision support system optimizing the resources during the response phase.</p>
                    <a href="https://geosafe.lessonsonfire.eu" target="_blank" class="project-link">More</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Footer -->
<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
