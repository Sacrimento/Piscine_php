#!/usr/bin/php
<?php

    if ($argc > 1)
    {
	$array = array_values(array_filter(explode(" ", $argv[1])));
	for ($i = 1; $i < count($array); $i++)
	    echo $array[$i] . " ";
	echo $array[0] . "\n";
    }

?>