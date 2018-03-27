#!/usr/bin/php
<?php

    if ($argc == 4)
    {
	$arg1 = (trim($argv[1], " \t"));
	$arg2 = trim($argv[2], " \t");
	$arg3 = (trim($argv[3], " \t"));

	if ($arg2 == "+")
	   echo $arg1 + $arg3 . "\n";
	else if ($arg2 == "-")
	   echo $arg1 - $arg3 . "\n";
	else if ($arg2 == "/")
	   echo $arg1 / $arg3 . "\n";
	else if ($arg2 == "*")
	   echo $arg1 * $arg3 . "\n";
	else if ($arg2 == '%')
	   echo $arg1 % $arg3 . "\n";
    }
    else
        echo "Incorrect Parameters\n";
?>