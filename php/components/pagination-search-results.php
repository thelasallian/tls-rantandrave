<!-- 
    This file contains the pagination code for the search results page.
    Unlike the pagination for category subpages (Movie, Music, etc.), all
    search results are fetched all-at-once, rather than per page. The array
    containing the search results are then filtered, then sliced into 24 per
    page.

    The reason for this is because the WordPress endpoint URL for search queries
    also returns articles that matches only substring. For example, if I searched
    "marvel", WordPress also returns articles that contain "marvelous."

    If we filter those per page, there would be an inconsistent number of articles
    displayed per page.

    But if you have another solution please do tell me because nakakaloka this is the
    first time I've done this.
 -->

<?php

// The page to display (Usually is received in a url parameter)
$page = intval($_GET['page']); // FIXME: Fix the Undefined array key "page" warning for this

// The number of records to display per page
$page_size = 24;

// Calculate total number of records, and total number of pages
$total_records = count($_SESSION["all_articles"]);
$total_pages   = ceil($total_records / $page_size);

// Validation: Page to display can not be greater than the total number of pages
if ($page > $total_pages) {
    $page = $total_pages;
}

// Validation: Page to display can not be less than 1
if ($page < 1) {
    $page = 1;
}

// Calculate the position of the first record of the page to display
$offset = ($page - 1) * $page_size;

// Get the subset of records to be displayed from the array
$subset_articles = array_slice($_SESSION["all_articles"], $offset, $page_size);

?>