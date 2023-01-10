<?php
    $first_article = $_SESSION["ARTICLE_INFO_ALL"][0];
    $visual_url = $first_article["jetpack_featured_media_url"];
?>

<footer style="background: linear-gradient(rgba(20, 20,20,0.87), rgba(20,20,20,0.87)), url(<?php echo $visual_url; ?>);">
    <div class="container">
        <div class="row">
            <!-- Left Side: TLS and Site Name -->
            <div class="col-sm-12 col-lg-6 mx-auto d-flex justify-content-center align-self-center align-items-lg-start text-center">
                <figure class="my-auto">
                    <!-- Logo -->
                    <a href="index.php">
                        <img src="assets/tls-logo-star-white.png" alt="TLS Logo" class="footer-logo mb-4 img-fluid" style="width:18%">
                    </a>
                    <!-- Logo Heading -->
                    <figcaption class="footer-heading fs-4">Menagerie</figcaption>
                    <figcaption class="footer-title fs-1">Rant & Rave</figcaption>
                </figure>
            </div>
            <!-- Description -->
            <div class="col-sm-12 col-lg-6 d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
                <!-- Description -->
                <p class="footer-description my-auto">
                    <strong>The LaSallian</strong> is the official student publication of De La Salle University.
                    It is of the students, by the students, and for the students. Our student writers, photographers,
                    videographers, and web managers are committed to the 61-year tradition of journalistic excellence
                    and issue-oriented critical thinking.
                </p>
                <!-- Link to Main Website -->
                <p class="footer-link-main-site my-auto"><a href="https://thelasallian.com"><strong>Go to Main Website →</strong></a></p>
                <!-- Website Developers -->
                <p class="footer-developers my-auto">Copyright 2022 © <strong>The LaSallian</strong><br>
                Website developed by <a href="https://github.com/angelocguerra" target="_blank">Angelo Guerra</a> and <a href="https://github.com/ronnparcia" target="_blank">Ronn Parcia,</a>
                <br> designed with Alyssa Wee and Addie Holgado, and conceptualized by Emmanuelle Castañeda</p>
            </div>
        </div>
    </div>    
</footer>