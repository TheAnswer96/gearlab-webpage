<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Selected Publications</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<!-- Section -->
<section class="block-section">
    <div class="container">

        <br>
        <h2><b>List of Publications</b></h2>
        <br>

        <?php
        // Function to fetch DBLP data for a given PID
        function fetchDBLPDataByPID($pid) {
            $url = "https://dblp.org/pid/" . $pid . ".xml";
            $response = file_get_contents($url);

            if ($response === FALSE) {
                return "Error fetching data from DBLP.";
            }

            return $response;
        }

        // Example usage with multiple PIDs
        $pids = ["25/927", "306/6867", "222/8346", "p/MCPinotti", "n/AlfredoNavarra"]; // Replace these with the actual PIDs
//        $pids = ["25/927", "306/6867"]; // Replace these with the actual PIDs

        // Array to store unique keys and years
        $uniqueKeys = [];

        foreach ($pids as $pid) {
            $dblpData = fetchDBLPDataByPID($pid);

            // Check if the XML data is valid before conversion
            if ($dblpData !== "Error fetching data from DBLP.") {
                // Convert XML to JSON
                $jsonResult = json_decode(json_encode(simplexml_load_string($dblpData)), true);

                // Collect unique keys and years
                foreach ($jsonResult['r'] as $entry) {
                    $article = $entry['article'] ?? null;
                    $inproceedings = $entry['inproceedings'] ?? null;

//                    $jsonString = json_encode($entry, JSON_PRETTY_PRINT);
//                    echo '<pre>' . $jsonString . '</pre>';

                    if ($article) {
                        $type = 'article';
                    } elseif ($inproceedings) {
                        $type = 'inproceedings';
                    } else {
                        // Skip entries without article or inproceedings
                        continue;
                    }

                    $typeEntry = $entry[$type];
                    $key = $typeEntry['@attributes']['key'] ?? 'N/A';
                    $year = $typeEntry['year'] ?? 'N/A';

                    // Skip entries with keys containing "journals/corr/abs"
                    if (strpos($key, 'corr') !== false) {
                        continue;
                    }

                    // Store unique keys and years in the array
                    if (!isset($uniqueKeys[$year])) {
                        $uniqueKeys[$year] = [];
                    }

                    if (!in_array($key, array_column($uniqueKeys[$year], 'key'))) {
                        // Additional fields for "article" entry
                        $articleFields = [];
                        if ($type === 'article') {
                            $articleFields = [
                                'pages' => $typeEntry['pages'] ?? 'N/A',
                                'year' => $typeEntry['year'] ?? 'N/A',
                                'volume' => $typeEntry['volume'] ?? 'N/A',
                                'journal' => $typeEntry['journal'] ?? 'N/A',
                            ];
                        }

                        // Additional fields for "inproceedings" entry
                        $inproceedingsFields = [];
                        if ($type === 'inproceedings') {
                            $inproceedingsFields = [
                                'pages' => $typeEntry['pages'] ?? 'N/A',
                                'year' => $typeEntry['year'] ?? 'N/A',
                                'booktitle' => $typeEntry['booktitle'] ?? 'N/A',
                            ];
                        }

                        $authors = is_array($typeEntry['author']) ? $typeEntry['author'] : [$typeEntry['author']];

                        $uniqueKeys[$year][] = [
                            'key' => $key,
                            'entry' => $typeEntry,
                            'authors' => $authors,
                            'articleFields' => $articleFields,
                            'inproceedingsFields' => $inproceedingsFields,
                            'doi' => $typeEntry['ee'] ?? 'N/A',
                        ];
                    }
                }
            } else {
                // Handle the error case
                echo '<p>Error fetching data for PID: ' . $pid . '</p>';
            }
        }

        // Sort entries by year in descending order
        krsort($uniqueKeys);

        // Output HTML structure
        foreach ($uniqueKeys as $year => $entries) {
            // Skip old entries
            if ($year < 2014) {
                continue;
            }

            echo '<div class="box">';
            echo '<h2>' . $year . '</h2>';
            echo '<div class="block-content">';
            echo '<ul>';
            foreach ($entries as $entry) {
                $key = $entry['key'];
                $title = $entry['entry']['title'] ?? 'N/A';
                $authors = implode(", ", $entry['authors'] ?? '');
                $authors = preg_replace('/\d+/', '', $authors);
                $doi = $entry['entry']['ee'] ?? 'N/A';

                // Additional fields for "article" entry
                $articleFields = $entry['articleFields'] ?? [];
                $inproceedingsFields = $entry['inproceedingsFields'] ?? [];

                $output = '<li>';

                if (!empty($articleFields)) {
                    $doiLink = is_array($doi) ? $doi[0] : $doi;
                    $output .= $authors . ': <a href="' . $doiLink . '" target="_blank"><i>' . $title . '</i></a>';
                    $output .= ' <b>' . $articleFields['journal'] . '</b> ' . $articleFields['volume'] . ': ' . $articleFields['pages'] . ' (' . $year . ')';
                } elseif (!empty($inproceedingsFields)) {
                    $doiLink = is_array($doi) ? $doi[0] : $doi;
                    $output .= $authors . ': <a href="' . $doiLink . '" target="_blank"><i>' . $title . '</i></a>';
                    $output .= ' <b>' . $inproceedingsFields['booktitle'] . '</b> ' . $inproceedingsFields['pages'] . ' (' . $year . ')';
                }

                $output .= '</li>';
                echo $output;

            }
            echo '</ul>';
            echo '</div>';
            echo '</div>';
        }

        ?>







<!--        <div class="box">-->
<!--            <h2>2024</h2>-->
<!--            <div class="block-content">-->
<!--                <ul>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Alfredo Navarra, Lorenzo Palazzetti, Cristina M. Pinotti, Giuseppe Prencipe:-->
<!--                        <i>Wireless IoT sensors data collection reward maximization by leveraging multiple energy- and storage-constrained UAVs.</i>-->
<!--                        <b>J. Comput. Syst. Sci.</b> 139: 103475 (2024)</li>-->
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="box">-->
<!--            <h2>2023</h2>-->
<!--            <div class="block-content">-->
<!--                <ul>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Lorenzo Palazzetti, Cristina M. Pinotti:-->
<!--                        <i>YOLO-based detection of Halyomorpha halys in orchards using RGB cameras and drones.</i>-->
<!--                        <b>Comput. Electron. Agric.</b> 213: 108228 (2023)</li>-->
<!---->
<!--                    <li>Chengyi Qu, Francesco Betti Sorbelli, Rounak Singh, Prasad Calyam, Sajal K. Das:-->
<!--                        <i>Environmentally-Aware and Energy-Efficient Multi-Drone Coordination and Networking for Disaster Response.</i>-->
<!--                        <b>IEEE Trans. Netw. Serv. Manag.</b> 20(2): 1093-1109 (2023)</li>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Federico Corò, Lorenzo Palazzetti, Cristina M. Pinotti, Giulio Rigoni:-->
<!--                        <i>How the Wind Can Be Leveraged for Saving Energy in a Truck-Drone Delivery System.</i>-->
<!--                        <b>IEEE Trans. Intell. Transp. Syst.</b> 24(4): 4038-4049 (2023)</li>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Cristina M. Pinotti, Giulio Rigoni:-->
<!--                        <i>On the Evaluation of a Drone-Based Delivery System on a Mixed Euclidean-Manhattan Grid.</i>-->
<!--                        <b>IEEE Trans. Intell. Transp. Syst.</b> 24(1): 1276-1287 (2023)</li>-->
<!---->
<!--                    <li>Anas Alsoliman, Giulio Rigoni, Davide Callegaro, Marco Levorato, Cristina M. Pinotti, Mauro Conti:-->
<!--                        <i>Intrusion Detection Framework for Invasive FPV Drones Using Video Streaming Characteristics.</i>-->
<!--                        <b>ACM Trans. Cyber Phys. Syst.</b> 7(2): 12:1-12:29 (2023)</li>-->
<!---->
<!--                    <li>Serafino Cicerone, Alessia Di Fonso, Gabriele Di Stefano, Alfredo Navarra:-->
<!--                        <i>Molecular Oblivious Robots: A New Model for Robots With Assembling Capabilities.</i>-->
<!--                        <b>IEEE Access</b> 11: 15701-15724 (2023)</li>-->
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="box">-->
<!--            <h2>2022</h2>-->
<!--            <div class="block-content">-->
<!--                <ul>-->
<!---->
<!--                    <li>Mohammad Abouei Mehrizi, Federico Corò, Emilio Cruciani, Gianlorenzo D'Angelo:-->
<!--                        <i>Election control through social influence with voters' uncertainty.</i>-->
<!--                        <b>J. Comb. Optim.</b> 44(1): 635-669 (2022)</li>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Federico Corò, Sajal K. Das, Lorenzo Palazzetti, Cristina M. Pinotti:-->
<!--                        <i>On the Scheduling of Conflictual Deliveries in a last-mile delivery scenario with truck-carried drones.</i>-->
<!--                        <b>Pervasive Mob. Comput.</b> 87: 101700 (2022)</li>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Cristina M. Pinotti, Simone Silvestri, Sajal K. Das:-->
<!--                        <i>Measurement Errors in Range-Based Localization Algorithms for UAVs: Analysis and Experimentation.</i>-->
<!--                        <b>IEEE Trans. Mob. Comput.</b> 21(4): 1291-1304 (2022)</li>-->
<!---->
<!--                    <li>Francesco Betti Sorbelli, Stefano Carpin, Federico Corò, Sajal K. Das, Alfredo Navarra, Cristina M. Pinotti:-->
<!--                        <i>Speeding up Routing Schedules on Aisle Graphs With Single Access.</i>-->
<!--                        <b>IEEE Trans. Robotics</b> 38(1): 433-447 (2022)</li>-->
<!---->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->

        <br>
        <br>
        <br>
        <br>

    </div>
</section>


<!-- Footer -->
<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
