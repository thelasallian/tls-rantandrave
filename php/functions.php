<?php

/**
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


?>