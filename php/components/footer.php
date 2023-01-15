<footer style="background-image: linear-gradient(rgba(20, 20,20,0.87), rgba(20,20,20,0.87)), url(<?php echo $footer_bg; ?>);">
    <div class="container">
        <div class="row">
            <!-- Left Side: TLS and Site Name -->
            <div class="col-sm-12 col-lg-6 mx-auto d-flex justify-content-center align-self-center align-items-lg-start text-center">
                <div class="my-auto">
                    <!-- Logo -->
                    <a href="index.php">
                        <img src="assets/tls-logo-star-white.png" alt="TLS Logo" class="footer-logo mb-4 img-fluid" style="width:18%"></img>
                    </a>
                    <!-- Logo Heading -->
                    <p class="footer-heading fs-4">Menagerie</p>
                    <p class="footer-title rounded d-inline-block px-3 fs-1">Rant and Rave</p>
                </div>
            </div>
            <!-- Description -->
            <div class="col-sm-12 col-lg-6 d-flex flex-column align-items-center align-items-lg-start text-center text-lg-start">
                <!-- Description -->
                <p class="footer-description my-auto">
                    <strong>The LaSallian</strong> is the official student publication of De La Salle University.
                    It is of the students, by the students, and for the students. Our student writers, photographers,
                    videographers, and web managers are committed to the 62-year tradition of journalistic excellence
                    and issue-oriented critical thinking.
                </p>
                <!-- Link to Main Website -->
                <div class="d-flex align-items-center position-relative">
                    <a class="footer-link-main-site my-auto align-middle" href="https://thelasallian.com"><strong>Go to Main Website</strong></a>
                    <span class="material-icons my-auto">chevron_right</span>
                </div>
                <!-- Website Developers -->
                <p class="footer-developers my-auto">Copyright 2023 © <strong>The LaSallian</strong><br>
                Website developed by <a href="https://github.com/ronnparcia" target="_blank">Ronn Parcia</a> and <a href="https://github.com/angelocguerra" target="_blank">Angelo Guerra</a>,
                and designed with Alyssa Casandra Wee. <br/>Icons by Addie Holgado and Google Material Design.</p>
            </div>
        </div>
    </div>    
</footer>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" data-bs-theme="dark">
    <div class="modal-dialog search-modal-dialog">
        <div class="modal-content border-0">
            <!-- Modal Header -->
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title" id="searchModalLabel">Search Rant and Rave articles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Search Form -->
                <form action="search-results.php" method="post">
                    <div class="sm-wrapper">
                        <!-- Search Box -->
                        <input class="sm-textinput" type="text" name="search-query">
                        <!-- Submit Button -->
                        <button class="sm-submitbtn" type="submit">
                            <span class="material-icons text-white">search</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>