#!/usr/bin/php
<?php

    if ($argc == 2)
    {
	    $array = array_filter(explode(" ", $argv[1]));
	    $i = 0;
	    foreach ($array as $word)
	    {   if ($i++ != 0)
	         	echo " ";
	        echo $word;
	    }
	    echo "\n";
    }

?>