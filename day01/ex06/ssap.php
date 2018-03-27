#!/usr/bin/php
<?php
    function ft_split($string)
    {
	return array_filter(explode(" ", $string));
    }

    if ($argc > 1)
    {
	$array = [];
	$array2 = [];
	for ($i = 1; $i < $argc; $i++)
	    array_push($array, $argv[$i]);
	foreach ($array as $words)
	     $array2 = array_merge($array2, ft_split($words));
	sort($array2);
	foreach ($array2 as $word)
	    echo $word . "\n";
    }
?>