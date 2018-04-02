<?php
	define('thisismychild', TRUE);
	if (!isset($_SESSION))
	    session_start();
?>

<?php include_once('./config.php') ?>
<?php include_once('./functions.php') ?>
<?php include('./includes/header.php') ?>
<?php include('./includes/navbar.php') ?>
<?php include('./includes/produits.php') ?>
<?php include('./includes/footer.php') ?>