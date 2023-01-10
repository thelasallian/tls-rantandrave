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
    <?php
        # Fetch Artile Info
        $first_article = $_SESSION["ARTICLE_INFO_ALL"][0];
        initialize_article_info(
            $first_article,
            $visual_url,
            $title,
            $date,
            $authors,
            $rating,
            $article_url,
            $excerpt
        );
        $excerpt = $first_article["excerpt"]["rendered"];
        $excerpt = str_replace("<p>", "", $excerpt);
        $article_tag = $first_article["tags"];

        # Conditional Header Styles
        if(in_array(2147, $article_tag)) // Movie
        {
            $header_style = 'linear-gradient(180deg, rgba(18, 193, 249, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:var(--movie-bg-85-darker);"';
            $title_style = 'style="color:#94E0F6"';
            $excerpt_style = 'background: rgba(15, 151, 191, 0.15);';
            $visual_style = 'border: 1px solid #072832; filter: drop-shadow(0px 4px 4px rgba(31, 54, 61, 0.85));';
        }
        else if(in_array(2107, $article_tag)) // Music
        {
            $header_style = 'linear-gradient(180deg, rgba(145, 176, 47, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#718829"';
            $title_style = 'style="color:#CCDF90;"';
            $excerpt_style = 'background: rgba(145, 176, 47, 0.15);';
            $visual_style = 'border: 1px solid #2F3321; filter: drop-shadow(0px 4px 4px rgba(70, 76, 49, 0.85));';
        }
        else if(in_array(2225, $article_tag)) // Television
        {
            $header_style = 'linear-gradient(180deg, rgba(201, 89, 163, 0.5) 17.49%, rgba(0, 0, 0, 0) 78.94%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#9D4980"';
            $title_style = 'style="color:#F2A7D9;"';
            $excerpt_style = 'background: rgba(201, 89, 163, 0.15);';
            $visual_style = 'border: 1px solid #33232E; filter: drop-shadow(0px 4px 4px rgba(76, 53, 69, 0.85));';
        }
        else if(in_array(2226, $article_tag)) // Miscellaneous
        {
            $header_style = 'linear-gradient(180deg, rgba(254, 175, 48, 0.5) 0%, rgba(0, 0, 0, 0) 74.48%), linear-gradient(0deg, rgba(57, 57, 57, 0.9), rgba(57, 57, 57, 0.9))';
            $rating_style = 'style="background-color:#B98229"';
            $title_style = 'style="color: #EFCF9A;"';
            $excerpt_style = 'background: rgba(254, 175, 48, 0.15);';
            $visual_style = 'border: 1px solid #332C21; filter: drop-shadow(0px 4px 4px rgba(77, 66, 49, 0.85));';
        }
        else // No tag
        {
            $header_style = 'style="background: linear-gradient(rgba(15,151,191,0.20), rgba(28,30,35,0.9)), url();"';
            $rating_style = 'style="background-color:rgba(15,151,191,1);"';
            $title_style = 'style="color:#94E0F6;"';
            $excerpt_style = 'style="color:white; background-color:rgba(15,151,191,.15);"';
        }
    ?>

    <header>
        <div class="header-bg" style="background: <?=$header_style?>, url(<?php echo $visual_url; ?>);">
        <a href="<?php echo $article_url; ?>" target="_blank" style="text-decoration:none">
        <div class="container py-5 px-2">
            <div class="row">    
                <!-- Header Article Text -->
                <div class="header-article pb-6 px-auto mx-auto col-sm-12 col-md-6 col-lg-6 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-lg-start text-center">
                
                    <!-- Rating -->
                    <p class="article-rating px-2 mb-3 d-inline-block rounded-pill" <?=$rating_style?> ><strong><?php echo $rating; ?></strong></p>
                    
                    <!-- Title -->
                    <h4 class="article-title mb-3" <?=$title_style?> > <strong><?php echo $title; ?></strong></h4>
                
                    <!-- Article Date & Author/s -->
                    <p class="article-date mb-0"><strong><?php echo $date; ?></strong></p> 
                    <p class="article-author mb-3"><?php echo $authors; ?></p>

                    <!-- Article Excerpt -->
                    <p class="article-excerpt d-inline-block rounded p-4" style="border-radius:0.8em; <?=$excerpt_style?>" ><?php echo $excerpt; ?></p>
                </div>

                <!-- Header Article Image -->
                <div class="header-article-image mx-auto col-sm-12 col-md-5 col-lg-5 d-flex justify-content-center align-items-center align-items-lg-start">
                    <img class="card-img w-100 h-100 rounded overflow-hidden" style="object-fit:cover; border-radius: 1.1em; <?=$visual_style?>" src="<?php echo $visual_url; ?>" alt="">
                </div>
            </div>
        </div></a></div>
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
                                 &$date, &$authors, &$rating, &$article_url, )
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