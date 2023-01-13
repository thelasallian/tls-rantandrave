<?php session_start(); ?>
<?php $wp_url = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,authors,content&tags=497&per_page=100"; ?>
<?php require_once 'php/functions/functions-global.php' ?>
<?php require_once 'php/functions/functions-subpages.php' ?>
<?php require_once 'php/functions/functions-search-results.php' ?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once 'php/components/head.php' ?>
    <link rel="stylesheet" href="css/subpages.css">

    <!-- Title -->
    <title>The LaSallian: Rant and Rave - Search</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
        $nav_bg_class = 'nav-hollowbg';
        require_once 'php/components/navbar.php'
    ?>

    <!-- Search Query Processing -->
    <?php require_once 'php/search-processing.php'; ?>

    <!-- Subpage Header Styles -->
    <?php
        $sh_bgimg = "'assets/search-bg.jpg'";
        $sh_gradientclass = 'sh-search';
        $sh_heading = 'Search: '.'"'.$_SESSION["search_query"].'"';
        $sh_iconpath = 'assets/search.png';
    ?>

    <!-- Subpage Header -->
    <?php
        render_subpage_header(
            $sh_bgimg,
            $sh_gradientclass,
            $sh_heading,
            $sh_iconpath
        ); 
    ?>

    <!-- Display Articles -->
    <section class="subpage-articles">
        <div class="container">
            <!-- Render cards for each article -->
            <?php 
                // Fetch articles
                $articles = $subset_articles;
                $ac_class = 'sp-ac-search';
                
                // Check if there are results
                if (count($articles) > 0) {
                    echo '<div class="row row-cols-1 row-cols-md-2">';
                    render_subpage_article_cards($articles, $ac_class); 
                    echo '</div>';
                } else { // Display message if there are no results and offer to search again
                    echo '';
                    echo <<<NO_RESULTS
                        <div class="container d-flex flex-column align-items-center">
                            <h4 class="text-center mb-5" style="max-width: 40rem;">
                                We could not find any results for your search. You can give it another try through the search form below.
                            </h4>
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
                    NO_RESULTS;
                }
            ?>
           
            <!-- Pagination Links -->
            <!-- Note: $total_pages not $page_count for this. Check pagination-search-results -->
            <?php render_page_links($total_pages, basename(__FILE__)); ?> 
        </div>
    </section>

    <!-- Footer -->
    <?php
        $footer_bg = $sh_bgimg;
        require_once 'php/components/footer.php';
    ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <!-- Navbar Scripts -->
    <script src="js/navbar-global.js"></script>
    <script src="js/navbar-subpages.js"></script>
</body>

</html>