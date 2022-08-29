<?php $wp_url = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,authors&tags=2147&per_page=100"; ?>
<?php require_once 'php/functions.php' ?>
<?php require_once 'php/session/session-subpages.php' ?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once 'php/components/head.php' ?>
    <link rel="stylesheet" href="css/subpages.css">

    <!-- Title -->
    <title>The LaSallian: Rant and Rave - Movie</title>
</head>

<body>
    <!-- Navbar -->
    <?php require_once 'php/components/navbar.php' ?>

    <!-- TEMP: Display articles -->
    <h1>Movie</h1>
    <?php
    $all_articles = $_SESSION["ARTICLE_INFO"];

    require_once 'php/components/pagination.php';

    foreach ($all_articles as $article) {
        initialize_article_info(
            $article, $visual_url, $title,
            $date, $authors, $article_url
        );
        echo $title;
        echo '<br/>';
    }

    render_page_links($pages_links, $page);
    ?>

    <!-- Footer -->
    <?php require_once 'php/components/footer.php' ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

<?php 

function initialize_article_info($article, &$visual_url, &$title,
                                 &$date, &$authors, &$article_url)
{
    $visual_url = $article["jetpack_featured_media_url"];
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $article_url = $article["link"];
}

?>