<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GEAR Lab - Home Page</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>

<!-- Navbar -->
<?php include_once('layout/header.html'); ?>

<!-- Carousel -->
<div id="myCarousel" class="carousel w-100 slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="img-fluid d-block w-100" src="images/home/image1.jpg" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img class="img-fluid d-block w-100" src="images/home/image2.jpg" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img class="img-fluid d-block w-100" src="images/home/image3.jpg" alt="Image 3">
        </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <!-- Button to reveal text section -->
<!--    <div class="reveal-button">-->
<!--        <button onclick="revealTextSection()">Discover More</button>-->
<!--    </div>-->
</div>

<!-- Text Sections -->
<div id="text-section" class="text-section">
    <h1>Latest News</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-6 image-content">
                <img src="images/post-icon/graduation-cap.png" class="news-icon" alt="Image 1">
            </div>
            <div class="col-md-6 text-content">
                <h2>New GEAR LAB Web Page</h2>
                <p>
                    We are thrilled to announce the official launch of GEAR LAB's highly anticipated web page! Get ready
                    to embark on a thrilling journey into the world of technology, innovation, and all things
                    gear-related.

                    At GEAR LAB, we understand that technology has become an integral part of our daily lives,
                    constantly evolving and shaping the way we work, play, and connect with the world. With our newly
                    launched web page, we aim to be your go-to resource for all your tech needs, catering to both
                    seasoned enthusiasts and curious newcomers.
                </p>
            </div>
        </div>
    </div>
    <!-- </br>
    <div class="container">
      <div class="row">
        <div class="col-md-6 image-content">
          <img src="images/home/image1.jpg" class="news-icon" alt="Image 1">
        </div>
        <div class="col-md-6 text-content">
          <h2>Section Title 1</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis lacus in libero tempus ornare. Sed a bibendum risus. Nullam eu sollicitudin risus. Fusce sollicitudin, metus id efficitur consectetur, felis dui posuere turpis, vitae vestibulum eros risus vel elit. Sed condimentum lorem in purus feugiat vulputate.</p>
        </div>
      </div>
    </div> -->
</div>

<!-- Footer -->
<?php include_once('layout/footer.html'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function revealTextSection() {
        var textSection = document.getElementById("text-section");
        var revealButton = document.getElementsByClassName("reveal-button")[0];
        textSection.style.display = "block";
        revealButton.style.display = "none";
    }
</script>
</body>

</html>
