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

<body>
    <!-- Header -->
    <header>
        <h1>Header</h1>
    </header>

    <!-- 2nd-5th Most Recent Articles -->
    <section>
        <h1>2nd-5th Most Recent Articles</h1>
    </section>

    <?php
    // Initialize list of RNR tags and their respective articles
    initialize_sections($sections);
    
    // Create a section for each RNR tag
    foreach ($sections as $section) {
        render_section($section);
    }
    ?>


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

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

function render_section($section)
{
    
    echo '<section id="'.$section["tag_name"].'"><div class="container">'; // Start of section
    echo '<h1>'.ucwords($section["tag_name"]).'</h1>'; // Display heading
    render_row($section["articles"]); // Display row of articles
    echo '</div></section>'; // End of section
}

function render_row($articles)
{
    echo '<div class="row row-cols-2 row-cols-lg-4">'; // Start of row
    // Display each article
    foreach ($articles as $article) {
        initialize_article_info($article, $visual_url, $title, $date, $authors, $rating, $article_url);
        
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
    echo '</div>'; // End of row
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

?>