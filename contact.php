<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Contact</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>
<body class="contact-page info-page">

<?php include_once('layout/header.html'); ?>

<section class="info-hero">
    <div class="container">
        <p class="info-eyebrow">GEAR Lab</p>
        <h1>Contact</h1>
        <p class="info-subtitle">Get in touch for collaborations, projects, and research opportunities.</p>
    </div>
</section>

<section class="info-section">
    <div class="container">
        <div class="info-grid">
            <article class="info-card">
                <h3>Department &amp; Address</h3>
                <p><strong>Dipartimento di Matematica e Informatica (DMI) - UNIPG</strong></p>
                <p>Via Luigi Vanvitelli, 1<br>06123 Perugia (PG), Italy</p>
            </article>
            <article class="info-card">
                <h3>Where to Find Us</h3>
                <p>The department is located in the historic center of Perugia, within walking distance from major city landmarks.</p>
                <a href="https://www.dmi.unipg.it" target="_blank" class="info-link">DMI Website</a>
            </article>
            <article class="info-card">
                <h3>Main Contacts</h3>
                <p>
                    <strong>Cristina M. Pinotti</strong><br>
                    <a href="mailto:cristina.pinotti@unipg.it">cristina.pinotti@unipg.it</a>
                </p>
                <p>
                    <strong>Francesco Betti Sorbelli</strong><br>
                    <a href="mailto:francesco.bettisorbelli@unipg.it">francesco.bettisorbelli@unipg.it</a>
                </p>
            </article>
        </div>

        <div class="info-card contact-map-card">
            <h3>Google Map</h3>
            <div class="contact-map-wrap">
                <iframe
                    title="DMI UNIPG Map"
                    src="https://www.google.com/maps?q=43.115886,12.385097&z=17&output=embed"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    allowfullscreen>
                </iframe>
            </div>
        </div>
    </div>
</section>

<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
