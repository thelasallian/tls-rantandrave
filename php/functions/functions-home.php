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
            <div class="article-card position-relative">
                <!-- Article Visual -->
                <img class="ac-visual rounded-3 mb-3" style="object-fit: cover;" src="{$visual_url}">

                <!-- Rating -->
                <span class="ac-rating d-inline-block rounded-5 mb-3 {$article_rating_class}">{$rating}</span>
                
                <!-- Article Title and Date -->
                <div class="ac-title-date d-block rounded-3 mb-3 {$article_title_class}">
                    <h2 class="ac-title mb-2">{$title}</h2>
                    <span class="ac-date fs-7">{$date}</span>
                </div>

                <!-- Stretched Link -->
                <a class="stretched-link" href="{$article_url}" target="_blank"></a>
            </div>
        ARTICLE;
    }
}

?>