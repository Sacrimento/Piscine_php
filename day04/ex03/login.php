<?php
    session_start();
    include("auth.php");
    if (!isset($_GET['login']) || $_GET['login'] === "" || $_GET['passwd'] === "" || isset($_GET['password'])) {
        echo "ERROR\n";
    }
    $_SESSION['logged_on_user'] = auth($_GET['login'], $_GET['passwd']) ? $_GET['login'] : "";
    echo ($_SESSION['logged_on_user'] === "" ? "ERROR\n" : "OK\n");
?>