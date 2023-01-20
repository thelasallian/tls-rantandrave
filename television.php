<?php $wp_url = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,authors&tags=2225"; ?>
<?php require_once 'php/functions/functions-global.php' ?>
<?php require_once 'php/functions/functions-subpages.php' ?>
<?php require_once 'php/components/pagination-category-subpages.php'; ?>
<?php require_once 'php/session/session-subpages.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once 'php/components/head.php' ?>
    <link rel="stylesheet" href="css/subpages.css">

    <!-- Title -->
    <title>The LaSallian: Rant and Rave - Shows</title>
</head>

<body>
    <!-- Navbar -->
    <?php 
        $nav_bg_class = 'nav-hollowbg';
        require_once 'php/components/navbar.php'
    ?>

    <!-- Subpage Header Styles -->
    <?php
        $most_recent_article = fetch_info('https://thelasallian.com/wp-json/wp/v2/posts?_fields=jetpack_featured_media_url&tags=2225&per_page=1&page=1');
        $sh_bgimg = $most_recent_article[0]["jetpack_featured_media_url"];
        $sh_gradientclass = 'sh-tv';
        $sh_heading = 'Shows';
        $sh_iconpath = 'assets/tv.png';
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
            <div class="row row-cols-1 row-cols-md-2">
                <!-- Fetch articles -->
                <?php
                    $articles = $_SESSION["ARTICLE_INFO"];
                    $ac_class = 'sp-ac-tv';
                ?>
                <!-- Render cards for each article -->
                <?php render_subpage_article_cards($articles, $ac_class); ?>
            </div>
            <!-- Pagination Links -->
            <?php render_page_links($page_count, basename(__FILE__)); ?>
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
    <script src="js/navbar-subpages.js"></script>
</body>

</html>