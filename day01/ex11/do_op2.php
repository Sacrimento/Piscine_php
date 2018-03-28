#!/usr/bin/php
<?php

    if ($argc == 2)
    {
        $parse = str_replace(" ", "", $argv[1]);
        $int1 = (int)($parse);
        $op = substr($parse, strlen($int1), 1);
        $int2 = substr($parse, strlen($int1) + 1);
        if (!is_numeric($int1) || !is_numeric($int2))
            die("Syntax Error\n");
        switch ($op) {
            case "+":
                $res = $int1 + $int2;
                break;
            case "-":
                $res = $int1 - $int2;
                break;
            case "*":
                $res = $int1 * $int2;
                break;
            case "/":
                $res = $int1 / $int2;
                break;
            case "%":
                $res = $int1 % $int2;
                break;
            default:
                die("Syntax Error\n");
        }
            echo "$res\n";
    } else {
        echo "Incorrect Parameters\n";
    }

?>