#!/usr/bin/php
<?php

    if ($argc > 1)
    {
	$i = 1;
	while ($i < $argc)
	     echo $argv[$i++] . "\n";
    }

?>