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
    <?php require_once 'php/components/navbar.php'; ?>

    <!-- Search Query Processing -->
    <?php require_once 'php/search-processing.php'; ?>

    <!-- Display Results -->
    <h1>Search Results</h1>
    <ol>
        <?php
        foreach ($subset_articles as $article) {
            // Initialize article information:
            init_article_info_searchsubpage(
                $article,
                $visual_url,
                $title,
                $date,
                $authors,
                $article_url,
                $content
            );

            echo <<<ARTICLE
                <li><a href="{$article_url}">{$title}</a></li>
            ARTICLE;
        }
        ?>
    </ol>

    <!-- Pagination Links -->
    <?php render_page_links($total_pages, basename(__FILE__)); ?>

    <!-- Footer -->
    <?php require_once 'php/components/footer.php'; ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>