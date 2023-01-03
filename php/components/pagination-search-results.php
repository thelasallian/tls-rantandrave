<!-- TODO: Add description to this file -->

<?php

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