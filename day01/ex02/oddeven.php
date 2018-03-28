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
			echo "Le chiffre " . $nbr . " est " . ($nbr % 2 ? "Impair" : "Pair");
	   } else {echo "'" . "$nbr" . "'" . " n'est pas un chiffre";}
	   echo "\n";
	}
}
fclose($stdin);
echo "\n";
?>