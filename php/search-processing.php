<?php

/* SEARCH PROCESSING */
if (intval($_GET['page']) == 0) {
    $_SESSION["search_query"] = $_POST["search-query"];
    $wp_url .= "&search=" . $_SESSION["search_query"]; // Append search query to WordPress url
    
    // Get the total number of pages of the list of articles
    $headers = get_headers($wp_url, true);
    $page_count = $headers["X-WP-TotalPages"]; 
    
    // Fetch all articles per page
    $_SESSION["all_articles"] = array();
    for ($i = 1; $i <= $page_count; $i++) {
        $orig_wp_url = $wp_url;
        $wp_url .= "&page=" . $i;
        $temp = fetch_info($wp_url);
        $_SESSION["all_articles"] = array_merge($_SESSION["all_articles"], $temp);

        $wp_url = $orig_wp_url;
    }

    // Filter out articles that don't match search query
    function filter_articles($value) {
        return (
            preg_match("/\b" . preg_quote($_SESSION["search_query"]) . "\b/i", $value["title"]["rendered"]) ||
            preg_match("/\b" . preg_quote($_SESSION["search_query"]) . "\b/i", $value["content"]["rendered"])
        );
    }

    $_SESSION["all_articles"] = array_filter($_SESSION["all_articles"], 'filter_articles');
}

/* MANUAL PAGINATION */

// The page to display (Usually is received in a url parameter)
$page = intval($_GET['page']);

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

// variables for pagination links
$page_first = $page > 1 ? 1 : '';
$page_prev  = $page > 1 ? $page - 1 : '';
$page_next  = $page < $total_pages ? $page + 1 : '';
$page_last  = $page < $total_pages ? $total_pages : '';

?>