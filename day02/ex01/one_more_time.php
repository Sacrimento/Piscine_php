#!/usr/bin/php
<?php

function is_in($str, $array)
{
    if (in_array($str, $array))
        return true;
    return false;
}

function value_err($array)
{
    if ($array[1] > 31 || $array[1] < 1)
        return true;
    if ($array[3] > 2038 || $array[3] < 1970)
        return true;
    $hours = explode(":", $array[4]);
    if ($hours[0] > 23 || $hours[0] < 0 || $hours[1] > 59 || $hours[1] < 0 || $hours[2] > 59 || $hours[2] < 0)
        return true;
    return false;
}

$months = array("janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre");
$days = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
if ($argc != 2)
    die();
if (!preg_match("/^[A-Za-z][a-z]+ {1}[0-9]{1,2} {1}[A-Za-z][a-z]+ {1}[0-9]{4} {1}[0-9]{2}:[0-9]{2}:[0-9]{2}$/", $argv[1]))
    die("Wrong Format\n");
$array = array_values(array_filter(explode(" ", $argv[1])));
if (!is_in(strtolower($array[0]), $days) || !is_in(strtolower($array[2]), $months))
    die("Wrong Format\n");
if (value_err($array))
    die("Wrong Format\n");
date_default_timezone_set("Europe/Paris");
array_shift($array);
$array[1] = array_search(strtolower($array[1]), $months) + 1;
echo strtotime("{$array[0]}-{$array[1]}-{$array[2]} {$array[3]}"), "\n";

?>
