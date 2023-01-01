<!-- Functions specific to category subpages (Movie, TV, Music, Miscellaneous) -->

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