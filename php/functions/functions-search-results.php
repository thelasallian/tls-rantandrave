<!-- TODO: Add description for this file -->
<!-- Functions Specific to Search Results -->
<?php

// TODO: Rename this function name (and across other files where it is called) to reflect that it's for search results only
/**
 * This function assigns the article information to individual variables
 * 
 * @param $article      an array containing the article's information
 * @param &$visual_url  the reference to the variable which will be assigned the article visual url
 * @param &$title       the reference to the variable which will be assigned the article title
 * @param &$date        the reference to the variable which will be assigned the article date
 * @param &$authors     the reference to the variable which will be assigned the article authors
 * @param &$article_url the reference to the variable which will be assigned the article url
 * @param &$content     the reference to the variable which will be assigned the article body. used for searching keywords
 */
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