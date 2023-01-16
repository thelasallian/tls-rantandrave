<?php

/*
    This file contains the pagination code for category subpages (Movie, Music, etc.).
    Note that this file is required_once'd first, before session-subpages.php. It does not
    manually slice the returned array of articles (unlike the pagination for search results),
    but appends the page number to the WordPress endpoint URL before the REST API function in session-subpages.
*/

// Specify the number of items per page. Important to specify before getting $page_count
// Note: $wp_url is defined in search-results.php at the beginning of the file.
$wp_url .= "&per_page=24"; 

// Get number of pages
$headers = get_headers($wp_url, true);
$page_count = $headers["X-WP-TotalPages"];

// Get current page number of current URL
if (isset($_GET['page'])) { // If there is a page parameter in the URL
    $page = intval($_GET['page']); 
} else { // Otherwise, assume that it's the first page
    $page = 1;
}

$wp_url .= "&page=".$page; // Append page number to WordPress url

?>