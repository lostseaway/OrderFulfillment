<?php

function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
 
$content = httpGet("http://track-trace.tk:8080/shipments/16/status");
$content = explode("\n", $content);
foreach($content as $header) {
		    // if (stripos($header, 'Location:') !== false) {
		       preg_match('/<status(.*?)status>/i', $header, $m );
		    // }
		}
var_dump($m[0]);
?>