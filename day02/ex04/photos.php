#!/usr/bin/php
<?php
if ($argc < 2)
    die();
$page_content = file_get_contents($argv[1]);
$url = strstr($argv[1], "www");
preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $page_content, $matches);
if(!is_dir($url))
    if (mkdir($url, 0777) == FALSE)
        die();
foreach($matches[1] as $elem)
{
    $filename = substr(strrchr($elem, "/"), 1);
    $fp = fopen($url."/".$filename, 'w+');
    if (strpos($elem, "http") !== 0)
        $ch = curl_init($url."/".$elem);
    else
        $ch = curl_init($elem);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_exec($ch);
    curl_close($ch);
    fclose($fp);
}
?>