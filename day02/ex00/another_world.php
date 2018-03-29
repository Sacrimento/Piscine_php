#!/usr/bin/php
<?php

    if ($argc < 2)
        die();
    $out =  trim(preg_replace("/[ \t]+/", " ", $argv[1]), " \t");
    echo $out;
    if ($out)
        echo "\n";
?>