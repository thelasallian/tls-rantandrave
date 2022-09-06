<?php session_start(); ?>
<?php $wp_url = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,authors,content&tags=497&per_page=100"; ?>
<?php require_once 'php/functions.php'; ?>

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
    <?php
    // If the url is at ?page=0, assign the search query to a session variable:
    if (intval($_GET['page']) == 0) {
        $_SESSION["search_query"] = $_POST["search-query"];
    }
    
    $wp_url .= "&search=" . $_SESSION["search_query"]; // Append search query to WordPress url
    require_once 'php/components/pagination.php';      // Apply pagination
    $all_articles = fetch_info($wp_url);               // Fetch articles for WordPress url (specific page)
    ?>

    <!-- Display Results -->
    <h1>Search Results</h1>
    <ol>
        <?php
        foreach ($all_articles as $article)
        {
            // Initialize article information:
            initialize_article_info(
                $article, $visual_url, $title, $date,
                $authors, $article_url, $content
            );

            // Add leading and trailing space before search query 

            // If the search query is found in the title or content, display the article:
            // if (stripos($title, $_SESSION["search_query"])   !== FALSE ||
            //     stripos($content, $_SESSION["search_query"]) !== FALSE   )
            if (preg_match("/\b".preg_quote($_SESSION["search_query"])."\b/i", $title) ||
                preg_match("/\b".preg_quote($_SESSION["search_query"])."\b/i", $content)   )
            {
                echo <<<ARTICLE
                    <li><a href="{$article_url}">{$title}</a></li>
                ARTICLE;
            }
        }
        ?>
    </ol>

    <!-- Pagination Links -->
    <?php render_page_links($page_count, basename(__FILE__)); ?>

    <!-- Footer -->
    <?php require_once 'php/components/footer.php'; ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

<?php

function initialize_article_info($article, &$visual_url, &$title, &$date,
                                 &$authors, &$article_url, &$content)
{
    $visual_url = $article["jetpack_featured_media_url"];
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $article_url = $article["link"];
    $content = $article["content"]["rendered"];
}

?>