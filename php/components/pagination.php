<?php

// Get number of pages
$headers = get_headers($wp_url, true);
$page_count = $headers["X-WP-TotalPages"];

// Get current page
$page = intval($_GET['page']);

// Default page
if ($page == 0) {
    $page = 1;
}

// Append page number to WordPress url
$wp_url .= "&page=".$page;

// Get articles from page
$articles = fetch_info($wp_url);

// Function to render page links
function render_page_links($page_count, $current_url)
{
    for ($i = 1; $i <= $page_count; $i++) {
        $page_url = $current_url."?page=".$i;
        echo <<<PAGE_LINK
            <a href="{$page_url}">{$i}</a>
        PAGE_LINK;
    }
}

?>