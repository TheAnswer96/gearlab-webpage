<?php
header('Content-Type: application/json; charset=UTF-8');

function countByClass($path, $className) {
    $html = @file_get_contents($path);
    if ($html === false) {
        return 0;
    }

    preg_match_all('/class="([^"]+)"/', $html, $matches);
    $count = 0;
    foreach ($matches[1] as $classList) {
        $tokens = preg_split('/\s+/', trim($classList));
        if (in_array($className, $tokens, true)) {
            $count++;
        }
    }

    return $count;
}

function fetchDBLPXmlByPid($pid) {
    $url = 'https://dblp.org/pid/' . $pid . '.xml';
    $context = stream_context_create([
        'http' => [
            'timeout' => 6,
            'user_agent' => 'GEARLabWeb/1.0',
        ],
    ]);

    return @file_get_contents($url, false, $context);
}

function countCurrentYearPublications($pids, $targetYear) {
    $seenKeys = [];
    $fetchedAny = false;

    foreach ($pids as $pid) {
        $xmlString = fetchDBLPXmlByPid($pid);
        if ($xmlString === false) {
            continue;
        }
        $fetchedAny = true;

        if (function_exists('simplexml_load_string')) {
            $xml = simplexml_load_string($xmlString);
            if ($xml === false) {
                continue;
            }

            foreach ($xml->r as $record) {
                $node = null;
                if (isset($record->article)) {
                    $node = $record->article;
                } elseif (isset($record->inproceedings)) {
                    $node = $record->inproceedings;
                }

                if ($node === null) {
                    continue;
                }

                $key = (string) ($node['key'] ?? '');
                $year = (int) ($node->year ?? 0);
                if ($key !== '' && $year === $targetYear && strpos($key, 'corr') === false) {
                    $seenKeys[$key] = true;
                }
            }
            continue;
        }

        if (class_exists('DOMDocument')) {
            $doc = new DOMDocument();
            libxml_use_internal_errors(true);
            $ok = $doc->loadXML($xmlString);
            libxml_clear_errors();
            if (!$ok) {
                continue;
            }

            foreach (['article', 'inproceedings'] as $tagName) {
                foreach ($doc->getElementsByTagName($tagName) as $node) {
                    $key = $node->getAttribute('key');
                    $yearNodes = $node->getElementsByTagName('year');
                    $year = $yearNodes->length > 0 ? (int) trim($yearNodes->item(0)->textContent) : 0;
                    if ($key !== '' && $year === $targetYear && strpos($key, 'corr') === false) {
                        $seenKeys[$key] = true;
                    }
                }
            }
        }
    }

    return [
        'count' => count($seenKeys),
        'fetchedAny' => $fetchedAny,
    ];
}

$currentYear = (int) date('Y');
$cachePath = sys_get_temp_dir() . '/gearlab_stats_cache_v3_' . $currentYear . '.json';
$cacheTtlSeconds = 15 * 60;

if (is_file($cachePath) && (time() - filemtime($cachePath)) < $cacheTtlSeconds) {
    $cached = @file_get_contents($cachePath);
    if ($cached !== false) {
        echo $cached;
        exit;
    }
}

$pubStats = countCurrentYearPublications(['25/927', '306/6867', '222/8346', 'p/MCPinotti', 'n/AlfredoNavarra'], $currentYear);

$stats = [
    'currentYear' => $currentYear,
    'fundedProjects' => countByClass(__DIR__ . '/projects.php', 'project-card'),
    'people' => countByClass(__DIR__ . '/team.php', 'team-card'),
    'recentPublications' => $pubStats['fetchedAny'] ? $pubStats['count'] : null,
];

$json = json_encode($stats);
if ($json === false) {
    echo '{"currentYear":' . $currentYear . ',"fundedProjects":0,"people":0,"recentPublications":0}';
    exit;
}

if ($pubStats['fetchedAny']) {
    @file_put_contents($cachePath, $json);
}
echo $json;
