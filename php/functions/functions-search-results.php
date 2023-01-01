<!-- TODO: Add description for this file -->
<!-- Functions Specific to Search Results -->
<?php

// TODO: Add documentation
// TODO: Rename this function name (and across other files where it is called) to reflect that it's for search results only
function initialize_article_info(
    $article, 
    &$visual_url, 
    &$title, 
    &$date,
    &$authors,
    &$article_url,
    &$content
) {
    $visual_url = $article["jetpack_featured_media_url"];
    $title = del_kicker($article["title"]["rendered"]);
    $date = date('F j, Y', strtotime($article["date"]));
    $authors = get_authors($article["authors"]);
    $article_url = $article["link"];
    $content = $article["content"]["rendered"];
}

?>