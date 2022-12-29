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
        <section id="<?php echo $section["tag_name"]; ?>" class="mb-5">
            <div class="container">
                <!-- Heading -->
                <div class="d-flex justify-content-between mb-5">
                    <!-- Tag Name and Icon -->
                    <div class="tag-section-heading d-flex align-items-center">
                        <img class="tag-section-icon me-4" src="<?php echo $section["icon_url"] ?>" alt="" />
                        <h1 class="mb-0"><?php echo ucwords($section["tag_name"]); ?></h1>
                    </div>
                    <!-- View All Link -->
                    <div class="d-flex align-items-center position-relative">
                        <a class="text-reset text-decoration-none stretched-link me-2" href="<?php echo $section["view_all_url"]; ?>">View All</a>
                        <span class="material-icons">chevron_right</span>
                    </div>
                </div>
                <!-- Articles -->
                <div class="row row-cols-2 row-cols-lg-4">
                    <?php render_article_cards($section["articles"], $section["article_rating_class"], $section["article_title_class"]); ?>
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
            "icon_url" => "assets/movie.png",
            "article_rating_class" => "movie-bg-85",
            "article_title_class" => "movie-bg-15",
            "view_all_url" => "movie.php"
        ),
        array(
            "tag_name" => "television",
            "articles" => $_SESSION["ARTICLE_INFO_TV"],
            "icon_url" => "assets/tv.png",
            "article_rating_class" => "tv-bg-85",
            "article_title_class" => "tv-bg-15",
            "view_all_url" => "television.php"
        ),
        array(
            "tag_name" => "music",
            "articles" => $_SESSION["ARTICLE_INFO_MUSIC"],
            "icon_url" => "assets/music.png",
            "article_rating_class" => "music-bg-85",
            "article_title_class" => "music-bg-15",
            "view_all_url" => "music.php"
        ),
        array(
            "tag_name" => "miscellaneous",
            "articles" => $_SESSION["ARTICLE_INFO_MISC"],
            "icon_url" => "assets/misc.png",
            "article_rating_class" => "misc-bg-85",
            "article_title_class" => "misc-bg-15",
            "view_all_url" => "miscellaneous.php"
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

function render_article_cards($articles, $article_rating_class, $article_title_class)
{
    foreach ($articles as $article) {
        initialize_article_info(
            $article, $visual_url, $title, $date,
            $authors, $rating, $article_url
        );
        
        echo <<<ARTICLE
            <div class="position-relative">
                <div class="ratio ratio-1x1 mb-4">
                    <img class="rounded-3" style="object-fit: cover;" src="{$visual_url}">
                </div>
                <!-- Rating -->
                <p class="article-card-rating d-inline-block rounded-5 {$article_rating_class}">{$rating}</p>
                <!-- Article Title -->
                <h2 class="d-block rounded-3 fs-5 p-3 mb-3 {$article_title_class}">{$title}</h2>
                <!-- Byline -->
                <p class="fs-7">
                    <span class="fw-bold">{$date}</span><br/>
                    <span>{$authors}</span>
                </p>
                <a class="stretched-link" href="{$article_url}" target="_blank"></a>
            </div>
        ARTICLE;
    }
}

?>