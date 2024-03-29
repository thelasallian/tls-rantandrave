<?php

/*
    This files contains functions that are used globally across several pages, regardless of kind.
*/

/**
 * fetch_info() gets the requested articles and their
 * information from The LaSallian's WordPress site.
 * 
 * @param string URL of the request 
 * @param string Request required. Defaults to GET.
 * @return assoc_array Returns a JSON santiized associative array of the API.
 * Code by Rafael Gabriel Arceo
 */
function fetch_info($url, $httpReq = 'GET')
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $httpReq,
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);
}

/**
 * has_rating() checks if article has a rating like "1.0/4.0"
 * 
 * @param string $content The article's content or body. 
 * @return string true if there is a rating, otherwise, false.
 */
function has_rating($content) {
    if (
        strpos($content, '0.0/4.0') !== false ||
        strpos($content, '1.0/4.0') !== false ||
        strpos($content, '1.5/4.0') !== false ||
        strpos($content, '2.0/4.0') !== false ||
        strpos($content, '2.5/4.0') !== false ||
        strpos($content, '3.0/4.0') !== false ||
        strpos($content, '3.5/4.0') !== false ||
        strpos($content, '4.0/4.0') !== false
    ) {
        return true;
    }

    return false;
}

/**
 * get_rating() finds and returns the rating within an article.
 * 
 * @param string $content The article's content or body. 
 * @return string Returns the n.n/n.n rating without surrounding HTML tags.
 */
function get_rating($content)
{
    if (strpos($content, "<h5 style=\"display: none;\">") !== false) { // Hidden H5{
        // Find the H5 heading and assign it to $rating
        $rating = strstr($content, "<h5 style=\"display: none;\">");
        $rating = strstr($rating, "</h5>", true);

        // Remove the surrounding <h5> and <strong> tags
        $rating = str_replace("<h5 style=\"display: none;\">", "", $rating);
        $rating = str_replace("</h5>", "", $rating);
        $rating = str_replace("<strong>", "", $rating);
        $rating = str_replace("</strong>", "", $rating);

        // Remove the 'Rating: ' prefix
        $rating = str_replace("Rating: ", "", $rating);
        $rating = str_replace("RATING: ", "", $rating); // Fallback if author used all caps
    } else if (strpos($content, '<h5>') !== false) { // If there's an H5
        // Find the H5 heading and assign it to $rating
        $rating = strstr($content, "<h5>");
        $rating = strstr($rating, "</h5>", true);

        // Remove the surrounding <h5> and <strong> tags
        $rating = str_replace("<h5>", "", $rating);
        $rating = str_replace("</h5>", "", $rating);
        $rating = str_replace("<strong>", "", $rating);
        $rating = str_replace("</strong>", "", $rating);

        // Remove the 'Rating: ' prefix
        $rating = str_replace("Rating: ", "", $rating);
        $rating = str_replace("RATING: ", "", $rating); // Fallback if author used all caps
    } else if (strpos($content, "<h5 style=\"display: none;\">") !== false) { // Hidden H5
        // Find the H5 heading and assign it to $rating
        $rating = strstr($content, "<h5 style=\"display: none;\">");
        $rating = strstr($rating, "</h5>", true);

        // Remove the surrounding <h5> and <strong> tags
        $rating = str_replace("<h5 style=\"display: none;\">", "", $rating);
        $rating = str_replace("</h5>", "", $rating);
        $rating = str_replace("<strong>", "", $rating);
        $rating = str_replace("</strong>", "", $rating);

        // Remove the 'Rating: ' prefix
        $rating = str_replace("Rating: ", "", $rating);
        $rating = str_replace("RATING: ", "", $rating); // Fallback if author used all caps
    } else if (has_rating($content)) { // Fallback, but actually this might have been a simpler solution. I don't know why I didn't think of it
        $rating = strstr($content, "/4.0", true);  // Find /4.0 in content and return anything before it
        $rating = substr($rating, -3); // Take only 3 characters from the end
        $rating .= '/4.0'; // Concatenate /4.0 since it was removed by strstr()
    } else {
        $rating = 'n/n';
    }
    
    return $rating;
}

/**
 * del_kicker() deletes the Rant and Rave (RNR) kicker from an article title.
 * 
 * @param string $title The article's title.
 * @return string Returns the title without the RNR kicker.
 */
function del_kicker($title)
{
    // Remove 'Rant and Rave: ' or 'Rant and Rave—' before the title
    $title = str_replace("Rant and Rave: ", "", $title);
    $title = str_replace("Rant and Rave—", "", $title);
    
    return $title;
}

/**
 * get_authors() appends listed authors into a single string.
 * 
 * @param assoc_array $arr_authors The list of authors.
 * @return string Returns the comma-separated list of authors in a single string.
 */
function get_authors($arr_authors)
{
    $str_authors = "";

    $i = 0;
    do {
        $str_authors .= $arr_authors[$i]["display_name"];
        $i++;
        if (!empty($arr_authors[$i]["display_name"])) {
            $str_authors .= ", ";
        }
    } while (!empty($arr_authors[$i]["display_name"]));

    return $str_authors;
}

?>