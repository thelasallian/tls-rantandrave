<!-- 
    This file fetches the 5 most recent RNR articles and the 4 most recent RNR articles
    per category (Movie, Music, etc) and stores them in the user's session. This is
    for the homepage.
 -->
 
<?php

/*  Wordpress Endpoints for 4 most recent articles per tag,
 *  5 most recent articles for $wp_url_all
 */
$wp_url_all   = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,tags,excerpt,content&,authorstags=497&per_page=5"; // All RNR articles
$wp_url_movie = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,tags,content,authors&tags=2147&per_page=4"; // 'Movie' tag
$wp_url_tv    = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,tags,content,authors&tags=2225&per_page=4"; // 'Television' tag
$wp_url_music = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,tags,content,authors&tags=2107&per_page=4"; // 'Music' tag
$wp_url_misc  = "https://thelasallian.com/wp-json/wp/v2/posts?_fields=title,link,jetpack_featured_media_url,date,tags,content,authors&tags=2226&per_page=4"; // 'Miscellaneous' tag

/* Code by Rafael Gabriel Arceo */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $_SESSION["TIME_ACCESSED"] = time();

    // Fetch all RNR articles and RNR articles by Movie, TV, Music, and Misc.
    $_SESSION["ARTICLE_INFO_ALL"]   = fetch_info($wp_url_all);
    $_SESSION["ARTICLE_INFO_MOVIE"] = fetch_info($wp_url_movie);
    $_SESSION["ARTICLE_INFO_TV"]    = fetch_info($wp_url_tv);
    $_SESSION["ARTICLE_INFO_MUSIC"] = fetch_info($wp_url_music);
    $_SESSION["ARTICLE_INFO_MISC"]  = fetch_info($wp_url_misc);
} else if (session_status() == PHP_SESSION_ACTIVE) {
    $dateInitiallyAccessed = new DateTime($_SESSION["TIME_ACCESSED"]);
    $dateNow = new DateTime(time());
    $difference = date_diff($dateInitiallyAccessed, $dateNow);
    $difference = date_diff($dateInitiallyAccessed, $dateNow);
    $eval = $difference->format('%h');

    // Refresh the time_accessed and article info after 10 hours
    if ($eval == "5 Hours") {
        $_SESSION["TIME_ACCESSED"] = time();
        
        // Fetch all RNR articles and RNR articles by Movie, TV, Music, and Misc.
        $_SESSION["ARTICLE_INFO_ALL"]   = fetch_info($wp_url_all);
        $_SESSION["ARTICLE_INFO_MOVIE"] = fetch_info($wp_url_movie);
        $_SESSION["ARTICLE_INFO_TV"]    = fetch_info($wp_url_tv);
        $_SESSION["ARTICLE_INFO_MUSIC"] = fetch_info($wp_url_music);
        $_SESSION["ARTICLE_INFO_MISC"]  = fetch_info($wp_url_misc);
    }
}

?>