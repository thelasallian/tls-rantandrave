<?php

/*
    This file fetches the RNR articles for specific categories (Movie, Music, etc.).
    This is used in movie.php, music.php, etc.
*/

/* Code by Rafael Gabriel Arceo */
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
//     $_SESSION["TIME_ACCESSED"] = time();
//     $_SESSION["ARTICLE_INFO"] = fetch_info($wp_url);
// } else if (session_status() == PHP_SESSION_ACTIVE) {
//     $dateInitiallyAccessed = new DateTime($_SESSION["TIME_ACCESSED"]);
//     $dateNow = new DateTime(time());
//     $difference = date_diff($dateInitiallyAccessed, $dateNow);
//     $difference = date_diff($dateInitiallyAccessed, $dateNow);
//     $eval = $difference->format('%h');

//     // Refresh the time_accessed and article info after 10 hours
//     if ($eval == "5 Hours") {
//         $_SESSION["TIME_ACCESSED"] = time();
//         $_SESSION["ARTICLE_INFO"] = fetch_info($wp_url);
//     }
// }

// Session was causing an error

$_SESSION["ARTICLE_INFO"] = fetch_info($wp_url);

?>