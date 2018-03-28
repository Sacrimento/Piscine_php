#!/usr/bin/php
<?php

    if ($argc == 1)
        die();
    echo trim(preg_replace("/[\s\t]+/", " ", $argv[1]), " \t"), "\n";
?>