#!/usr/bin/php
<?php

     function ft_split($string)
     {
	return array_values(array_filter(explode(" ", $string)));
     }

    if ($argc > 1)
    {
	    $alpha = [];
     	$num = [];
     	$other = [];
    	$main = [];

	for ($i = 1; $i < $argc; $i++)
	    $main = array_merge($main, ft_split($argv[$i]));

	foreach ($main as $word)
	{
	     if (is_numeric($word))
	     	$num[] = $word;
	     else if (ctype_alpha($word))
	     	$alpha[] = $word;
	     else
		    $other[] = $word;
	}
	
	sort($num, SORT_STRING);
	sort($alpha, SORT_FLAG_CASE | SORT_NATURAL);
	sort($other);	
	$alpha = array_merge($alpha, $num);
	$alpha = array_merge($alpha, $other);

	foreach ($alpha as $w)
	    echo $w . "\n";
    }
?>