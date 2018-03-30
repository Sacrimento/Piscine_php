<?php

    function error()
    {
        echo "ERROR\n";
        return ;
    }

    if (!isset($_POST['submit']) || $_POST['submit'] !== "OK") {
        error(); return ;
    }
    if (isset($_POST['login']) && $_POST['login'] !== "")
        $login = $_POST['login'];
    else { error(); return ;}
    if (isset($_POST['passwd']) && $_POST['passwd'] !== "")
        $passwd = hash("whirlpool", $_POST['passwd']);
    else { error(); return ;}

    if (!file_exists("../private/"))
        mkdir("../private", 0777);
    if (file_exists("../private/passwd")) {
        $str = file_get_contents("../private/passwd");
        $array = unserialize($str);
    }
    else
        $array = [];
    foreach ($array as $i)
    {
        if ($i['login'] === $login) {
            error(); return ;
        }
    }
    $array[] = array("login" => $login, "passwd" => $passwd);
    file_put_contents("../private/passwd", serialize($array));
    echo "OK\n";
?>