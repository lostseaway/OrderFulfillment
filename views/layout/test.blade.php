<?php
$string = "HTTP/1.1 201 Created Date: Sun, 14 Dec 2014 16:19:46 GMT Access-Control-Allow-Origin: * Access-Control-Allow-Methods: POST, PUT, GET, DELETE Access-Control-Allow-Headers: Content-Type, Accept, Authorization Location: http://track-trace.tk:8080/shipments/16 Content-Length: 0 Server: Jetty(9.2.z-SNAPSHOT)";
preg_match('~shipments/(\d+)~', $string, $m );
var_dump($m[1]); // $m[1] is your string
?>