<?php

/* Code taken from https://davescripts.com/php-pagination-of-an-array-of-data */

// The page to display (Usually is received in a url parameter)
$page = intval($_GET['page']);

// The number of records to display per page
$page_size = 25;

// Calculate total number of records, and total number of pages
$total_records = count($all_articles);
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
$all_articles = array_slice($all_articles, $offset, $page_size);

// page links
$N = min($total_pages, 9);
$pages_links = array();

$tmp = $N;
if ($tmp < $page || $page > $N) {
    $tmp = 2;
}
for ($i = 1; $i <= $tmp; $i++) {
    $pages_links[$i] = $i;
}

if ($page > $N && $page <= ($total_pages - $N + 2)) {
    for ($i = $page - 3; $i <= $page + 3; $i++) {
        if ($i > 0 && $i < $total_pages) {
            $pages_links[$i] = $i;
        }
    }
}

$tmp = $total_pages - $N + 1;
if ($tmp > $page - 2) {
    $tmp = $total_pages - 1;
}
for ($i = $tmp; $i <= $total_pages; $i++) {
    if ($i > 0) {
        $pages_links[$i] = $i;
    }
}

function render_page_links($pages_links, $page)
{
     $prev = 0; 
     foreach ($pages_links as $p) { 
        if (($p - $prev) > 1) { 
            echo '<a href="#">...</a>';
        } 
        $prev = $p; 

        
        $style_active = '';
        if ($p == $page) {
            $style_active = 'style="font-weight:bold"';
        }
        
        echo <<<LINK
            <a {$style_active}  href="movie.php?page={$p}">{$p}</a>
        LINK;
     } 
}

?>