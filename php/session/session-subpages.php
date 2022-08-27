<?php

/* Code by Rafael Gabriel Arceo */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["TIME_ACCESSED"] = time();
    $_SESSION["ARTICLE_INFO"] = [];

    // Fetch articles
    $headers = get_headers($wp_url, true);
    $page_count = $headers["X-WP-TotalPages"]; // Get the total number of pages of the list of articles

    // Fetch all articles per page
    for ($i = 1; $i <= $page_count; $i++) {
        $orig_wp_url = $wp_url;
        $wp_url .= "&page=".$i;
        $temp = fetch_info($wp_url);
        $_SESSION["ARTICLE_INFO"] = array_merge($_SESSION["ARTICLE_INFO"], $temp);

        $wp_url = $orig_wp_url;
    }
} else if (session_status() == PHP_SESSION_ACTIVE) {
    $dateInitiallyAccessed = new DateTime($_SESSION["TIME_ACCESSED"]);
    $dateNow = new DateTime(time());
    $difference = date_diff($dateInitiallyAccessed, $dateNow);
    $difference = date_diff($dateInitiallyAccessed, $dateNow);
    $eval = $difference->format('%h');

    // Refresh the time_accessed and article info after 10 hours
    if ($eval == "5 Hours") {
        $_SESSION["TIME_ACCESSED"] = time();
        
        // Fetch articles
        $headers = get_headers($wp_url, true);
        $page_count = $headers["X-WP-TotalPages"]; // Get the total number of pages of the list of articles

        // Fetch all articles per page
        for ($i = 1; $i <= $page_count; $i++) {
            $orig_wp_url = $wp_url;
            $wp_url .= "&page=".$i;
            $temp = fetch_info($wp_url);
            $_SESSION["ARTICLE_INFO"] = array_merge($_SESSION["ARTICLE_INFO"], $temp);

            $wp_url = $orig_wp_url;
        }
    }
}
