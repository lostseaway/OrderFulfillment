<?php
$json = file_get_contents('http://128.199.212.108/jf-shop/api/v1/products/2');

$data = json_decode($json, TRUE);
?>
{{var_dump($data)}}