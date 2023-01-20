<?php

// This files contains functions that are used only in the homepage or index.php

/**
 * This function initializes the information for each category section
 * (Movie, Television, Music, and Miscellaneous). These include the name
 * of the section, the list of articles, the URL of the icon, the CSS
 * class for styling the rating and title wrapper, and the "View All" link.
 * 
 * @param &$sections  the reference to the array variable containing all section info
 */
function initialize_sections(&$sections)
{
    $sections = array(
        array(
            "tag_name" => "films",
            "articles" => $_SESSION["ARTICLE_INFO_MOVIE"],
            "icon_url" => "assets/movie.png",
            "article_rating_class" => "movie-bg-85",
            "article_title_class" => "movie-bg-15",
            "view_all_url" => "movie.php"
        ),
        array(
            "tag_name" => "shows",
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
            "tag_name" => "others",
            "articles" => $_SESSION["ARTICLE_INFO_MISC"],
            "icon_url" => "assets/misc.png",
            "article_rating_class" => "misc-bg-85",
            "article_title_class" => "misc-bg-15",
            "view_all_url" => "miscellaneous.php"
        )
    );
}

/**
 * This function assigns the article information to individual variables
 * 
 * @param $article      an array containing the article's information
 * @param &$visual_url  the reference to the variable which will be assigned the article visual url
 * @param &$title       the reference to the variable which will be assigned the article title
 * @param &$date        the reference to the variable which will be assigned the article date
 * @param &$authors     the reference to the variable which will be assigned the article authors
 * @param &$rating      the reference to the variable which will be assigned the article RNR rating
 * @param &$article_url the reference to the variable which will be assigned the article url
 */
function initialize_article_info(
    $article,
    &$visual_url,
    &$title,
    &$date,
    &$authors,
    &$rating,
    &$article_url
) {
    if ($article["jetpack_featured_media_url"] == "") { // If there's no article, use default visual
        $visual_url = 'assets/rnr-default-dark.jpg';
    } else {
        $visual_url = $article["jetpack_featured_media_url"];
    }
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $rating = get_rating($article["content"]["rendered"]);
    $article_url = $article["link"];
}

// TODO: Add documentation
function initialize_article_info_quickratings(
    $article,
    &$visual_url,
    &$title,
    &$date,
    &$tags,
    &$rating,
    &$article_url
) {
    if ($article["jetpack_featured_media_url"] == "") { // If there's no article, use default visual
        $visual_url = 'assets/rnr-default-dark.jpg';
    } else {
        $visual_url = $article["jetpack_featured_media_url"];
    }
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('M j, Y', strtotime($article["date"]));
    $tags = $article["tags"];
    $rating = get_rating($article["content"]["rendered"]);
    $article_url = $article["link"];
}

// TODO: Add documentation
function get_qr_bg_class($tags) {
    if (in_array(2147, $tags)) {// Movie
        return "movie-qr-card";
    } else if(in_array(2107, $tags)) {// Music
        return "music-qr-card";
    } else if(in_array(2225, $tags)) {// Television
        return "tv-qr-card";
    } else if(in_array(2226, $tags)) { // Miscellaneous
        return "misc-qr-card";
    } else { // No tag
        return "default-qr-card";
    }
}

// TODO: Add documentation
function get_qr_icon($tags) {
    if (in_array(2147, $tags)) {// Movie
        return "assets/movie-white.png";
    } else if(in_array(2107, $tags)) {// Music
        return "assets/music-white.png";
    } else if(in_array(2225, $tags)) {// Television
        return "assets/tv-white.png";
    } else if(in_array(2226, $tags)) { // Miscellaneous
        return "assets/misc-white.png";
    } else { // No tag
        return "assets/tls-logo-star-white.png";
    }
}

/**
 * This function renders the HTML for each article card
 * under a specific category (Movie, Music, etc.)
 * 
 * @param $articles             the array containing the list of articles   
 * @param $article_rating_class the CSS class name for styling the article rating
 * @param $article_title_class  the CSS class name for styling the article's wrapper for the title and date
 */
function render_article_cards(
    $articles,
    $article_rating_class,
    $article_title_class
) {
    foreach ($articles as $article) {
        initialize_article_info(
            $article, 
            $visual_url, 
            $title, 
            $date,
            $authors, 
            $rating, 
            $article_url
        );
        
        echo <<<ARTICLE
            <div class="article-card position-relative">
                <!-- Article Visual -->
                <img class="ac-visual mb-3" style="object-fit: cover;" src="{$visual_url}">

                <!-- Rating -->
                <span class="ac-rating d-inline-block rounded-5 mb-3 {$article_rating_class}">{$rating}</span>
                
                <!-- Article Title and Date -->
                <div class="ac-title-date d-block mb-3 {$article_title_class}">
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