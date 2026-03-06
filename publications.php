<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Publications</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;700&family=Source+Sans+3:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css?v=<?php echo filemtime(__DIR__ . '/style/style.css'); ?>">
</head>
<body class="publications-page">

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<section class="publications-hero">
    <div class="container">
        <p class="publications-eyebrow">GEAR Lab</p>
        <h1>Publications</h1>
        <p class="publications-subtitle">Selected articles and conference papers fetched from DBLP, grouped by year.</p>
    </div>
</section>

<section class="publications-section">
    <div class="container">
        <?php
        function esc($value) {
            return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
        }

        // Function to fetch DBLP data for a given PID.
        function fetchDBLPDataByPID($pid) {
            $url = "https://dblp.org/pid/" . $pid . ".xml";
            $context = stream_context_create([
                'http' => [
                    'timeout' => 10,
                    'user_agent' => 'GEARLabWeb/1.0',
                ],
            ]);
            $response = @file_get_contents($url, false, $context);

            if ($response === false) {
                return false;
            }

            return $response;
        }

        // Parse DBLP XML into a normalized list of publication entries.
        function parseDBLPPublications($xmlString) {
            $entries = [];

            if (function_exists('simplexml_load_string')) {
                $xml = simplexml_load_string($xmlString);
                if ($xml === false) {
                    return $entries;
                }

                foreach ($xml->r as $record) {
                    $type = null;
                    if (isset($record->article)) {
                        $type = 'article';
                    } elseif (isset($record->inproceedings)) {
                        $type = 'inproceedings';
                    }

                    if ($type === null) {
                        continue;
                    }

                    $node = $record->{$type};
                    $authors = [];
                    foreach ($node->author as $author) {
                        $authors[] = trim((string) $author);
                    }

                    $ees = [];
                    foreach ($node->ee as $ee) {
                        $ees[] = trim((string) $ee);
                    }

                    $entries[] = [
                        'type' => $type,
                        'key' => (string) ($node['key'] ?? ''),
                        'year' => (string) ($node->year ?? ''),
                        'title' => trim((string) ($node->title ?? 'N/A')),
                        'authors' => $authors,
                        'ee' => $ees,
                        'pages' => trim((string) ($node->pages ?? 'N/A')),
                        'volume' => trim((string) ($node->volume ?? 'N/A')),
                        'journal' => trim((string) ($node->journal ?? 'N/A')),
                        'booktitle' => trim((string) ($node->booktitle ?? 'N/A')),
                    ];
                }

                return $entries;
            }

            if (class_exists('DOMDocument')) {
                $doc = new DOMDocument();
                libxml_use_internal_errors(true);
                $ok = $doc->loadXML($xmlString);
                libxml_clear_errors();

                if (!$ok) {
                    return $entries;
                }

                $recordNodes = $doc->getElementsByTagName('r');
                foreach ($recordNodes as $record) {
                    $typeNode = null;
                    foreach (['article', 'inproceedings'] as $candidate) {
                        $nodes = $record->getElementsByTagName($candidate);
                        if ($nodes->length > 0) {
                            $typeNode = $nodes->item(0);
                            break;
                        }
                    }

                    if ($typeNode === null) {
                        continue;
                    }

                    $type = $typeNode->nodeName;
                    $authors = [];
                    foreach ($typeNode->getElementsByTagName('author') as $authorNode) {
                        $authors[] = trim($authorNode->textContent);
                    }

                    $ees = [];
                    foreach ($typeNode->getElementsByTagName('ee') as $eeNode) {
                        $ees[] = trim($eeNode->textContent);
                    }

                    $getFirstText = function ($tagName) use ($typeNode) {
                        $nodes = $typeNode->getElementsByTagName($tagName);
                        return $nodes->length > 0 ? trim($nodes->item(0)->textContent) : 'N/A';
                    };

                    $entries[] = [
                        'type' => $type,
                        'key' => $typeNode->getAttribute('key'),
                        'year' => $getFirstText('year'),
                        'title' => $getFirstText('title'),
                        'authors' => $authors,
                        'ee' => $ees,
                        'pages' => $getFirstText('pages'),
                        'volume' => $getFirstText('volume'),
                        'journal' => $getFirstText('journal'),
                        'booktitle' => $getFirstText('booktitle'),
                    ];
                }
            }

            return $entries;
        }

        $pids = ['25/927', '306/6867', '222/8346', 'p/MCPinotti', 'n/AlfredoNavarra'];

        $uniqueKeys = [];
        $fetchErrors = [];

        foreach ($pids as $pid) {
            $dblpData = fetchDBLPDataByPID($pid);

            if ($dblpData === false) {
                $fetchErrors[] = $pid;
                continue;
            }

            $parsedEntries = parseDBLPPublications($dblpData);

            foreach ($parsedEntries as $parsedEntry) {
                $type = $parsedEntry['type'];
                $key = $parsedEntry['key'] ?: 'N/A';
                $year = $parsedEntry['year'] ?: 'N/A';

                if (strpos($key, 'corr') !== false) {
                    continue;
                }

                if (!isset($uniqueKeys[$year])) {
                    $uniqueKeys[$year] = [];
                }

                if (!in_array($key, array_column($uniqueKeys[$year], 'key'), true)) {
                    $articleFields = [];
                    if ($type === 'article') {
                        $articleFields = [
                            'pages' => $parsedEntry['pages'] ?? 'N/A',
                            'volume' => $parsedEntry['volume'] ?? 'N/A',
                            'journal' => $parsedEntry['journal'] ?? 'N/A',
                        ];
                    }

                    $inproceedingsFields = [];
                    if ($type === 'inproceedings') {
                        $inproceedingsFields = [
                            'pages' => $parsedEntry['pages'] ?? 'N/A',
                            'booktitle' => $parsedEntry['booktitle'] ?? 'N/A',
                        ];
                    }

                    $uniqueKeys[$year][] = [
                        'key' => $key,
                        'title' => $parsedEntry['title'] ?? 'N/A',
                        'authors' => $parsedEntry['authors'] ?? [],
                        'articleFields' => $articleFields,
                        'inproceedingsFields' => $inproceedingsFields,
                        'doi' => $parsedEntry['ee'] ?? [],
                    ];
                }
            }
        }

        krsort($uniqueKeys);
        $currentYear = (int) date('Y');
        $minYear = $currentYear - 6;

        if (!empty($fetchErrors)) {
            echo '<div class="publications-alert">Some DBLP profiles could not be fetched right now.</div>';
        }

        if (empty($uniqueKeys)) {
            echo '<div class="publications-empty">No publications available at the moment.</div>';
        }

        foreach ($uniqueKeys as $year => $entries) {
            if (!is_numeric($year)) {
                continue;
            }

            $yearInt = (int) $year;
            if ($yearInt < $minYear || $yearInt > $currentYear) {
                continue;
            }

            echo '<article class="publication-year-card">';
            echo '<h2>' . esc($year) . '</h2>';
            echo '<ul class="publication-list">';

            foreach ($entries as $entry) {
                $title = $entry['title'] ?? 'N/A';
                $authors = implode(', ', $entry['authors'] ?? []);
                $authors = preg_replace('/\d+/', '', $authors);
                $doi = $entry['doi'] ?? [];

                $doiLink = '';
                if (is_array($doi) && !empty($doi)) {
                    $candidate = trim((string) $doi[0]);
                    if (filter_var($candidate, FILTER_VALIDATE_URL)) {
                        $doiLink = $candidate;
                    }
                } elseif (is_string($doi) && filter_var($doi, FILTER_VALIDATE_URL)) {
                    $doiLink = $doi;
                }

                $articleFields = $entry['articleFields'] ?? [];
                $inproceedingsFields = $entry['inproceedingsFields'] ?? [];

                $meta = '';
                if (!empty($articleFields)) {
                    $meta = ($articleFields['journal'] ?? 'N/A') . ' ' . ($articleFields['volume'] ?? 'N/A') . ': ' . ($articleFields['pages'] ?? 'N/A') . ' (' . $yearInt . ')';
                } elseif (!empty($inproceedingsFields)) {
                    $meta = ($inproceedingsFields['booktitle'] ?? 'N/A') . ' ' . ($inproceedingsFields['pages'] ?? 'N/A') . ' (' . $yearInt . ')';
                }

                echo '<li class="publication-item">';
                echo '<p class="publication-authors">' . esc($authors) . '</p>';

                if ($doiLink !== '') {
                    echo '<a href="' . esc($doiLink) . '" target="_blank" class="publication-title"><i>' . esc($title) . '</i></a>';
                } else {
                    echo '<p class="publication-title"><i>' . esc($title) . '</i></p>';
                }

                echo '<p class="publication-meta">' . esc($meta) . '</p>';
                echo '</li>';
            }

            echo '</ul>';
            echo '</article>';
        }
        ?>
    </div>
</section>

<!-- Footer -->
<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
