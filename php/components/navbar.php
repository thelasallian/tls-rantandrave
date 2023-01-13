<nav class="nav-darkbg navbar navbar-expand-md navbar-dark">
    <div class="container d-flex justify-content-between">
        <!-- Logo -->
        <a class="navbar-brand" href="https://thelasallian.com/" target="_blank">
            <img class="nav-logo" src="assets/tls-logo-star-white.png" alt="The LaSallian logo">
        </a>

        <div class="d-flex flex-grow-1 justify-content-end justify-content-md-center">
            <!-- Menu Button for Mobile Devices -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="offcanvas offcanvas-end flex-grow-0 text-bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <!-- Offcanvas Header  -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Rant and Rave</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- Offcanvas Body -->
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active text-reset" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset" href="movie.php">Movie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset" href="television.php">Television</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset" href="music.php">Music</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-reset" href="miscellaneous.php">Miscellaneous</a>
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