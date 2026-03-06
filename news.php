<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - News</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>
<body class="news-page info-page">

<?php include_once('layout/header.html'); ?>

<section class="info-hero">
    <div class="container">
        <p class="info-eyebrow">GEAR Lab</p>
        <h1>News</h1>
        <p class="info-subtitle">Recent milestones, project updates, and research highlights.</p>
    </div>
</section>

<section class="info-section">
    <div class="container">
        <div class="info-grid">
            <article class="info-card">
                <p class="info-meta">2026</p>
                <h3>Website Updated</h3>
                <p>
                    We have updated the GEAR Lab website with a modern layout, refreshed pages, and improved mobile
                    usability.
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
