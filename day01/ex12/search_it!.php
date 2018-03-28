#!/usr/bin/php
<?php

    if ($argc > 2)
    {
        $key = $argv[1];
        $hash = [];
        $argv[0] = $argv[1] = 0;
        foreach ($argv as $param)
        {
            if (count(($exp = explode(":", $param))) == 2)
                $hash[$exp[0]] = $exp[1];
        }
        if ($hash[$key])
            echo "$hash[$key]\n";
    }

?>