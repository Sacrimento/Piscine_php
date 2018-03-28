#!/usr/bin/php
<?php

function is_in($str, $array)
{
    if (in_array($str, $array))
        return true;
    return false;
}
$months = array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
$days = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
if ($argc != 2)
    die();
if (!preg_match("/^[A-Za-z][a-z]+ [0-9]{1,2} [A-Za-z][a-z]+ [0-9]{4} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $argv[1]))
    die("Wrong Format\n");
$array = array_values(array_filter(explode(" ", $argv[1])));
if (!is_in(strtolower($array[0]), $days) || !is_in(strtolower($array[2]), $months))
    die("Wrong Format\n");
date_default_timezone_set("Europe/Paris");
array_shift($array);
var_dump($array);
echo strtotime("$array[0]" . "-" . "($array[1] = array_search($array[1], $months) + 1)" . "-" . "$array[2])" . " " . "$array[3]"), "\n";
?>
