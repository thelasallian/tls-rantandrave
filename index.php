<?php require_once 'php/functions.php' ?>
<?php require_once 'php/session/session-home.php' ?>

<!doctype html>
<html lang="en">

<head>
    <?php require_once 'php/components/head.php' ?>
    <link rel="stylesheet" href="css/homepage.css">

    <!-- Title -->
    <title>The LaSallian: Rant and Rave</title>
</head>

<body class="text-white">
    <!-- Navbar -->
    <?php require_once 'php/components/navbar.php' ?>

    <!-- Header -->
    <header>
        <h1>Header</h1>
    </header>

    <!-- Quick Ratings (2nd-5th Most Recent Articles) -->
    <section>
        <h1>Quick Ratings (2nd-5th Most Recent Articles)</h1>
    </section>

    <!-- Tags (Movie, Television, Music, Miscellaneous) -->
    <?php initialize_sections($sections); // Initialize list of RNR tags and their respective articles ?>
    <?php foreach ($sections as $section): // Create a section for each RNR tag ?>
        <section id="<?php echo $section["tag_name"]; ?>">
            <div class="container">
                <h1><?php echo ucwords($section["tag_name"]); ?></h1>
                <div class="row row-cols-2 row-cols-lg-4">
                    <?php render_article_cards($section["articles"]); ?>
                </div>
            </div>
        </section>
    <?php endforeach; ?>

    <!-- Footer -->
    <?php require_once 'php/components/footer.php' ?>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

<!-- Homepage-specific Functions -->
<?php

function initialize_sections(&$sections)
{
    $sections = array(
        array(
            "tag_name" => "movie",
            "articles" => $_SESSION["ARTICLE_INFO_MOVIE"],
        ),
        array(
            "tag_name" => "television",
            "articles" => $_SESSION["ARTICLE_INFO_TV"],
        ),
        array(
            "tag_name" => "music",
            "articles" => $_SESSION["ARTICLE_INFO_MUSIC"],
        ),
        array(
            "tag_name" => "miscellaneous",
            "articles" => $_SESSION["ARTICLE_INFO_MISC"],
        )
    );
}

function initialize_article_info($article, &$visual_url, &$title,
                                 &$date, &$authors, &$rating, &$article_url)
{
    $visual_url = $article["jetpack_featured_media_url"];
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $rating = get_rating($article["content"]["rendered"]);
    $article_url = $article["link"];
}

function render_article_cards($articles)
{
    foreach ($articles as $article) {
        initialize_article_info(
            $article, $visual_url, $title, $date,
            $authors, $rating, $article_url
        );
        
        echo <<<ARTICLE
            <div class="position-relative">
                <div class="ratio ratio-1x1"><img style="object-fit: cover;" src="{$visual_url}"></div>
                <p>{$rating}</p>
                <h2 class="fs-5">{$title}</h2>
                <p>{$date}</p>
                <p>{$authors}</p>
                <a class="stretched-link" href="{$article_url}" target="_blank"></a>
            </div>
        ARTICLE;
    }
}

?>