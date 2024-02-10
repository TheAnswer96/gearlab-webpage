<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Proposed Thesis</title>
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
        <h2><b>Proposed Thesis</b></h2>
        <br>

        <div class="box">
            <h2>2024</h2>
            <div class="block-content">
                <ul>
                    <li>Develop an API tailored to DJI SDK 5.x, focusing specifically on compatibility
                        with the DJI Mini 3 Pro drone. While the official API does not support autonomous flight
                        missions
                        using the Wayline method with these drones, it does support the Virtual Stick method. Therefore,
                        the Virtual Stick method needs to be adapted to mimic the functionality of the Wayline method.
                        Proficiency in Android Studio and the Java programming language is necessary for this task.
                    </li>

                    <li>Develop a sensor localization system utilizing Ultra Wide Band (UWB) antennas, specifically
                        leveraging the PDoA kit from DecaWave. The objective is to create a system that can be utilized
                        by drones to localize ground sensors. This project involves both theoretical exploration and
                        practical implementation tasks. Proficiency in Raspberry Pi, Linux commands, C programming
                        language, and some hardware skills are necessary for successful execution.
                    </li>

                    <li>Develop a cross-platform app for semi-automatic annotation of an image dataset within the bug
                        detection system context. The app takes model predictions as input and should allow users to
                        confirm correct/incorrect bounding boxes and verify accurate annotations. Additionally, it
                        should enable the suggestion of bounding boxes missed by the model and facilitate the insertion
                        and validation of annotations using a certain selection mechanism. Possible environments include
                        Xamarin (C# or .NET) or Flutter (Java or Kotlin).
                    </li>

                    <li class="crossed-out">"Improve the comparison of weather data from established datasets with that
                        collected by a custom microclimate station located within an orchard. This requires thorough
                        analysis of diverse sources to assess bug detection rates in relation to current weather
                        conditions and geographic location. Additionally, participate in configuring a Jetson Nano on
                        the DJI Matrice 300 RTK to conduct machine learning-based recognition tasks as part of our
                        continuous endeavors."
                    </li>
                </ul>
            </div>
        </div>

        <div class="box">
            <h2>2023</h2>
            <div class="block-content">
                <ul>
                    <li class="crossed-out">Preliminary comparison of weather data between Arpae dataset and a custom
                        microclimate station located inside an orchard.
                    </li>
                </ul>
            </div>
        </div>

        <div class="box">
            <h2>2022</h2>
            <div class="block-content">
                <ul>
                    <li class="crossed-out">Implementation of drone-based delivery algorithms in a mixed
                        Euclidean-Manhattan Grids.
                    </li>
                </ul>
            </div>
        </div>

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
