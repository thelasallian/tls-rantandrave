<nav class="<?php echo $nav_bg_class; ?> navbar navbar-expand-md navbar-dark fixed-top" id="navbar">
    <div class="container d-flex justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand" href="https://thelasallian.com/" target="_blank">
            <img class="nav-logo" id="nav-logo" src="assets/tls-logo-star-white.png" alt="The LaSallian logo">
        </a>

        <div class="d-flex flex-grow-1 justify-content-end justify-content-md-center">
            <!-- Menu Button for Mobile Devices -->
            <button class="navbar-toggler p-0 border-0 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="material-icons">menu</span>
            </button>

            <!-- Links -->
            <div class="offcanvas offcanvas-end flex-grow-0" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!-- Offcanvas Header  -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Categories</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- Offcanvas Body -->
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <span class="material-icons" id="nav-link-icon-home">home</span>
                            <a class="nav-link active text-reset" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <span class="material-icons" id="nav-link-icon-movie">movie</span>
                            <a class="nav-link text-reset" href="films.php">Films</a>
                        </li>
                        <li class="nav-item">
                            <span class="material-icons" id="nav-link-icon-tv">tv</span>
                            <a class="nav-link text-reset" href="shows.php">Shows</a>
                        </li>
                        <li class="nav-item">
                            <span class="material-icons" id="nav-link-icon-music">music_note</span>
                            <a class="nav-link text-reset" href="music.php">Music</a>
                        </li>
                        <li class="nav-item">
                            <span class="material-icons" id="nav-link-icon-misc">more_horiz</span>
                            <a class="nav-link text-reset" href="miscellaneous.php">Others</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

        <!-- Search Icons -->
        <div class="d-flex justify-content-end" style="width: 4rem;">
            <!-- Button trigger Search modal -->
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#searchModal">
                <span class="material-icons text-white">search</span>
            </button>

        </div>

    </div>
</nav>