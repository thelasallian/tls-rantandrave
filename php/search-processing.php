<!-- 
    This file contains the PHP code for search processing. The page get the search query
    typed in the previous page's search text field, and appends it to a WordPress endpoint URL.
    This URL is then passed to the REST API function, and the returned array is filtered to 
    remove articles that matched only the search query as a substring.
 -->

<?php

/**
 * SEARCH PROCESSING
 */
if (!isset($_GET['page'])) { // If first time loading the search results
    // Get the search query entered by the user in the previous page
    $_SESSION["search_query"] = $_POST["search-query"];

    // Replace spaces, if any, with a plus sign to prevent errors
    $_SESSION["search_query"] = str_replace(' ', '+', $_SESSION["search_query"]);

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

    // Revert the replacement of spaces to plus signs
    $_SESSION["search_query"] = str_replace('+', ' ', $_SESSION["search_query"]);
    
    // Filter non-exact matches (Check array_filter documentation)
    $_SESSION["all_articles"] = array_filter($_SESSION["all_articles"], 'filter_articles');
}

/**
 * PAGINATE THE RESULTS
 */
require_once('php/components/pagination-search-results.php');

?>