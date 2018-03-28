#!/usr/bin/php
<?php

    if ($argc == 4)
    {
	    $int1 = trim($argv[1], " \t");
	    $op = trim($argv[2], " \t");
	    $int2 = trim($argv[3], " \t");

	    switch ($op) {
            case "+":
                echo $int1 + $int2 . "\n";
                break;
            case "-":
                echo $int1 - $int2 . "\n";
                break;
            case "/":
                echo $int1 / $int2 . "\n";
                break;
            case "*":
                echo $int1 * $int2 . "\n";
                break;
            case "%":
                echo $int1 % $int2 . "\n";
                break;
            default:
                die();
        }
    }
    else
        echo "Incorrect Parameters\n";
?>