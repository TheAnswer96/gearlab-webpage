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
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>

<body class="home-page">

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<?php
function countFundedProjectsFromPage($path) {
    $html = @file_get_contents($path);
    if ($html === false) {
        return 0;
    }

    preg_match_all('/class="([^"]+)"/', $html, $matches);
    $count = 0;
    foreach ($matches[1] as $classList) {
        $tokens = preg_split('/\s+/', trim($classList));
        if (in_array('project-card', $tokens, true)) {
            $count++;
        }
    }

    return $count;
}

function countPeopleFromTeamPage($path) {
    $html = @file_get_contents($path);
    if ($html === false) {
        return 0;
    }

    preg_match_all('/class="([^"]+)"/', $html, $matches);
    $count = 0;
    foreach ($matches[1] as $classList) {
        $tokens = preg_split('/\s+/', trim($classList));
        if (in_array('team-card', $tokens, true)) {
            $count++;
        }
    }

    return $count;
}

$currentYear = (int) date('Y');
$fundedProjectsCount = countFundedProjectsFromPage(__DIR__ . '/projects.php');
$peopleCount = countPeopleFromTeamPage(__DIR__ . '/team.php');
?>

<section class="home-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 hero-content">
                <p class="hero-eyebrow">University of Perugia</p>
                <h1>GEAR Lab - Group of rEsearch in Algorithms for emeRgent models</h1>
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
                    <?php
                    $heroImages = glob(__DIR__ . '/images/home/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
                    sort($heroImages);
                    if (empty($heroImages)) {
                        $heroImages = [__DIR__ . '/images/home/image2.jpg'];
                    }
                    ?>
                    <div id="homeHeroCarousel" class="carousel slide carousel-fade hero-carousel" data-ride="carousel" data-interval="5500">
                        <div class="carousel-inner">
                            <?php foreach ($heroImages as $index => $imagePath): ?>
                                <?php $relativePath = 'images/home/' . basename($imagePath); ?>
                                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                    <img src="<?php echo htmlspecialchars($relativePath, ENT_QUOTES, 'UTF-8'); ?>"
                                         alt="GEAR Lab activity <?php echo $index + 1; ?>"
                                         class="hero-carousel-image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-about">
    <div class="container">
        <h2>Research Focus</h2>
        <p>
            At GEAR LAB, in the last couple of years, we have concentrated on algorithms for the UAV world: localization
            algorithms, data collection in agriculture by integrating IoT devices on the ground, power-line maintenance,
            urban monitoring, and last-mile deliveries. We are also studying an infrastructure of web cameras distributed
            across urban areas to replace human control and make autonomous UAV flights in cities feasible and safe.
            Communication aspects are always central in our applications. Our methodology starts from deep structural
            modeling of each problem and then develops combinatorial algorithms (DP, ILP) with guaranteed performance,
            validated through experimental simulations. As complexity grows, structural modeling and analysis can become
            harder than learning. For this reason, we are integrating learning models in specific phases of UAV
            applications, including computer vision for invasive pest detection in agriculture, crop replication in
            digital labs, UAV flight monitoring in urban areas, and ground-driven UAV swarm control.
        </p>
        <a href="research.php" class="home-about-link">Go to Research</a>
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
                <span class="snapshot-number" id="stat-funded-projects"><?php echo $fundedProjectsCount; ?></span>
                <span class="snapshot-label">Funded Projects</span>
            </div>
            <div class="snapshot-card">
                <span class="snapshot-number" id="stat-recent-publications">-</span>
                <span class="snapshot-label" id="stat-recent-publications-label">Recent Publications (<?php echo $currentYear; ?>)</span>
            </div>
            <div class="snapshot-card">
                <span class="snapshot-number" id="stat-people"><?php echo $peopleCount; ?></span>
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
                    <a href="projects.php" class="news-link">Go to Grants</a>
                </article>
            </div>
            <div class="col-md-4 mb-4">
                <article class="news-card">
                    <img src="images/post-icon/certificate.png" alt="Publication icon">
                    <h3>Publications Updated</h3>
                    <p class="news-meta">2026</p>
                    <p>The publications list now loads directly from DBLP and is continuously aligned with current output.</p>
                    <a href="publications.php" class="news-link">Go to Publications</a>
                </article>
            </div>
            <div class="col-md-4 mb-4">
                <article class="news-card">
                    <img src="images/post-icon/computer.png" alt="Team icon">
                    <h3>Team and Collaborator Updates</h3>
                    <p class="news-meta">2026</p>
                    <p>The team page reflects current positions and external collaborations across partner institutions.</p>
                    <a href="team.php" class="news-link">Go to Team</a>
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
<script>
    (function () {
        var fundedProjectsEl = document.getElementById('stat-funded-projects');
        var recentPublicationsEl = document.getElementById('stat-recent-publications');
        var recentPublicationsLabelEl = document.getElementById('stat-recent-publications-label');
        var peopleEl = document.getElementById('stat-people');
        var requestUrl = 'stats.php?t=' + Date.now();

        function applyStats(data) {
            if (typeof data.fundedProjects === 'number') {
                fundedProjectsEl.textContent = data.fundedProjects;
            }
            if (typeof data.recentPublications === 'number') {
                recentPublicationsEl.textContent = data.recentPublications;
            }
            if (typeof data.currentYear === 'number') {
                recentPublicationsLabelEl.textContent = 'Recent Publications (' + data.currentYear + ')';
            }
            if (typeof data.people === 'number') {
                peopleEl.textContent = data.people;
            }
        }

        if (window.AbortController && window.fetch) {
            var controller = new AbortController();
            var timeoutId = setTimeout(function () {
                controller.abort();
            }, 12000);

            fetch(requestUrl, {cache: 'no-store', signal: controller.signal})
                .then(function (response) {
                    clearTimeout(timeoutId);
                    if (!response.ok) {
                        throw new Error('Unable to load stats');
                    }
                    return response.text();
                })
                .then(function (body) {
                    var data = JSON.parse(body);
                    applyStats(data);
                })
                .catch(function () {
                    recentPublicationsEl.textContent = '-';
                });
            return;
        }

        // Fallback for environments where fetch/AbortController is unavailable.
        var xhr = new XMLHttpRequest();
        xhr.open('GET', requestUrl, true);
        xhr.timeout = 12000;
        xhr.onreadystatechange = function () {
            if (xhr.readyState !== 4) {
                return;
            }
            if (xhr.status >= 200 && xhr.status < 300) {
                try {
                    applyStats(JSON.parse(xhr.responseText));
                } catch (e) {
                    recentPublicationsEl.textContent = '-';
                }
                return;
            }
            recentPublicationsEl.textContent = '-';
        };
        xhr.ontimeout = function () {
            recentPublicationsEl.textContent = '-';
        };
        xhr.onerror = function () {
            recentPublicationsEl.textContent = '-';
        };
        xhr.send();
    })();
</script>
</body>

</html>
