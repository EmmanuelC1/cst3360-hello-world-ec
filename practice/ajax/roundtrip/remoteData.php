<?php 
function getDataFromOtherSite(url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curlResult = curl_exec($curl);
    curl_close($curl);
    return json_decode($curlResult);
}
?>