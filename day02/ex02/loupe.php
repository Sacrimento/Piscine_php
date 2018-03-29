#!/usr/bin/php
<?php
if ($argc > 1)
{
    $file = file_get_contents($argv[1]);
    $fi = preg_replace('[<a .+?</a>]ie', 'strtoupper("$0")', $file);
    print_r($fi);
    $file = preg_replace('[<.+?>]ie', 'strtolower("$0")', $file);
    $file = preg_replace('/(?<=title=")[^"]+/ei', 'strtoupper("$0")', $file);
    echo $file;
}
?>