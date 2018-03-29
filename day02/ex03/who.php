#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
$handle = fopen("/var/run/utmpx", "r");
$output = [];
while ($my_str = fread($handle, 628))
{
    $array = unpack("a256user/a4id/a32line/ipid/itype/i2time/a256host", $my_str);
    if ($array['type'] === 7)
        array_push($output,$array['user']." ".$array['line']."  ".date("M j H:i", $array['time1'])."\n");
}
sort($output, SORT_NATURAL);
foreach($output as $value)
    echo $value;
?>