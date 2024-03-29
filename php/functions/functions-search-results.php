<?php

// This files contains functions that are used only in the search results subpage (search-results.php).

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
function init_article_info_searchsubpage(
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

/**
 * Checks if the search query is found as a string in
 * the article's body or title.
 * 
 * This solution was lifted from StackOverflow.
 * 
 * @param $value  an array containing a single article's information
 * @return false  if the article merely contains a substring of the search query (e.g. search query
 *                is "beta" but article contains only "betadine" and not the exact word)
 */
function filter_articles($value) {
    return (
        preg_match("/\b" . preg_quote($_SESSION["search_query"]) . "\b/i", $value["title"]["rendered"]) ||
        preg_match("/\b" . preg_quote($_SESSION["search_query"]) . "\b/i", $value["content"]["rendered"])
    );
}

?>