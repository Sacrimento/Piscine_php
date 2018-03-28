#!/usr/bin/php
<?php
    function ft_split($string)
    {
	    return array_filter(explode(" ", $string));
    }

    if ($argc > 1)
    {
	    $array = [];
	    for ($i = 1; $i < $argc; $i++)
	         $array = array_merge($array, ft_split($argv[$i]));
	    sort($array);
	    foreach ($array as $word)
	        echo $word . "\n";
    }
?>