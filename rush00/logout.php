<?php
    session_start();
    define('thisismychild', true);
    include_once('./config.php');
    include_once('./functions.php');
?>
<?php
include_once('./user.php');

if (!empty($_SESSION['logged_on_user']))
{
	logout();
	header('location: /index.php');
	exit();
} else {
	header('location: /index.php');
	exit();
}

?>