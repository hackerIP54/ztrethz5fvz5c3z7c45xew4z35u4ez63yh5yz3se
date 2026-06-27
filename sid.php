<?php
function getSID($user, $pass) {
    $url = "http://fritz.box/login_sid.lua";

    $xml = @simplexml_load_file($url);
    if(!$xml) return null;

    $challenge = $xml->Challenge;

    $response = $challenge . "-" . md5(mb_convert_encoding($challenge . "-" . $pass, "UCS-2LE", "UTF-8"));

    $loginURL = $url . "?username=" . urlencode($user) . "&response=" . $response;

    $xml2 = @simplexml_load_file($loginURL);

    if(!$xml2) return null;

    return (string)$xml2->SID;
}
?>
