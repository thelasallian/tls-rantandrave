<?php

// Specify the number of items per page. Important to specify before getting $page_count
$wp_url .= "&per_page=24"; 

// Get number of pages
$headers = get_headers($wp_url, true);
$page_count = $headers["X-WP-TotalPages"];

// Get current page
$page = intval($_GET['page']); // FIXME: Fix the Undefined array key "page" warning for this

// Default page
if ($page == 0) {
    $page = 1;
}

$wp_url .= "&page=".$page; // Append page number to WordPress url

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