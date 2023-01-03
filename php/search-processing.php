<!-- 
    This file contains the PHP code for search processing. The page get the search query
    typed in the previous page's search text field, and appends it to a WordPress endpoint URL.
    This URL is then passed to the REST API function, and the returned array is filtered to 
    remove articles that matched only the search query as a substring.
 -->

<?php

// TODO: Add more detailed documentation to this file

/**
 * SEARCH PROCESSING
 */
if (intval($_GET['page']) == 0) { // FIXME: Fix the Undefined array key "page" warning for this
    // Get the search query entered by the user in the previous page
    $_SESSION["search_query"] = $_POST["search-query"];

    // Append the search query to the WordPress Endpoint URL.
    // Note: $wp_url is defined in search-results.php at the beginning of the file.
    $wp_url .= "&search=" . $_SESSION["search_query"];
    
    // Get the total number of pages of the list of articles
    $headers = get_headers($wp_url, true);
    $page_count = $headers["X-WP-TotalPages"]; 
    
    // Create array that will store all search results
    $_SESSION["all_articles"] = array();

    // Fetch all articles per result page
    for ($i = 1; $i <= $page_count; $i++) {
        $orig_wp_url = $wp_url;

        // Append page number to WordPress Endpoint URL
        $wp_url .= "&page=" . $i;

        // Fetch articles on that result page and append it to array
        $temp = fetch_info($wp_url);
        $_SESSION["all_articles"] = array_merge($_SESSION["all_articles"], $temp);

        // Un-append the page number from the endpoint URL
        $wp_url = $orig_wp_url;
    }

    $_SESSION["all_articles"] = array_filter($_SESSION["all_articles"], 'filter_articles');
}

// TODO: Consider moving this to a new file called pagination-searchresults.php
/* MANUAL PAGINATION */

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