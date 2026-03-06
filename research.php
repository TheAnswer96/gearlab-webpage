<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Research</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>
<body class="research-page info-page">

<?php include_once('layout/header.html'); ?>

<section class="info-hero">
    <div class="container">
        <p class="info-eyebrow">GEAR Lab</p>
        <h1>Research</h1>
        <p class="info-subtitle">Current research lines in drones, unmanned vehicles, and algorithmic optimization.</p>
    </div>
</section>

<section class="info-section">
    <div class="container">
        <div class="info-card">
            <h2>Current Research Lines</h2>
            <p>
                Our research encompasses drone and unmanned vehicle applications across different domains. In sensor
                localization, we investigate range-based and range-free algorithms by leveraging flying anchors and
                Ultra-Wideband (UWB) devices for accurate and scalable solutions. In drone delivery, we design optimal
                and approximation algorithms for minimizing travel distances in mixed rural-urban areas, including wind
                effects and hybrid drone-truck systems. In smart agriculture, we address irrigation and pest scouting in
                vineyards and orchards using robots and drones, with graph-based models such as aisle-graphs. For BVLoS
                drone flights, we use multi-layer weighted graph models to optimize paths while considering safety and
                connectivity constraints. We also contribute to drone-based video monitoring, disaster response with
                learning algorithms, and countermeasures against jamming and spoofing threats.
            </p>
            <div class="research-pill-row">
                <span class="research-pill">Agriculture</span>
                <span class="research-pill">BVLoS</span>
                <span class="research-pill">Delivery</span>
                <span class="research-pill">WSN</span>
                <span class="research-pill">Localization</span>
            </div>
        </div>

        <div class="info-grid">
            <article class="info-card">
                <h3>Agriculture</h3>
                <p>
                    Smart agriculture applications for orchards and vineyards, including irrigation support, pest scouting,
                    and UAV/robot-assisted monitoring with algorithmic route optimization.
                </p>
            </article>

            <article class="info-card">
                <h3>BVLoS</h3>
                <p>
                    Multi-layer weighted graph models and risk/connectivity-aware algorithms for beyond visual line of sight
                    operations in urban and mixed environments.
                </p>
            </article>

            <article class="info-card">
                <h3>Delivery</h3>
                <p>
                    Optimal, approximation, and heuristic algorithms for last-mile logistics, including hybrid truck-drone
                    systems, wind-aware planning, and mixed Euclidean-Manhattan scenarios.
                </p>
            </article>

            <article class="info-card">
                <h3>WSN</h3>
                <p>
                    Wireless sensor network data collection and communication-aware planning, with energy/storage-constrained
                    UAVs and robust scheduling strategies.
                </p>
            </article>

            <article class="info-card">
                <h3>Localization</h3>
                <p>
                    Range-based and range-free localization algorithms using flying anchors, directional antennas, and UWB
                    technologies for accurate and scalable positioning.
                </p>
            </article>
        </div>

    </div>
</section>

<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
