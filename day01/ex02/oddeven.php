#!/usr/bin/php
<?php
$stdin = fopen("php://stdin", "r");
while ($stdin && !feof($stdin))
{
	echo "Entrez un nombre: ";
	$nbr = fgets($stdin);
	if ($nbr) {
	   $nbr = str_replace("\n", "", $nbr);
	   if (is_numeric($nbr))
	   {
			echo "Le chiffre " . $nbr . " est ";
			if ($nbr % 2) {
		   	   echo "Impair";
			}
			else {
		   	     echo "Pair";
			}
	   } else {echo "'" . "$nbr" . "'" . " n'est pas un nombre !";}
	   echo "\n";
	}
}
fclose($stdin);
echo "\n";
?>