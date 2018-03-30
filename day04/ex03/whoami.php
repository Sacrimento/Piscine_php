<?php
    session_start();
    if ($_SESSION['logged_on_user'] === "" || !isset($_SESSION['logged_on_user']))
        echo "ERROR\n";
    else
        echo $_SESSION['logged_on_user'], "\n";
?>