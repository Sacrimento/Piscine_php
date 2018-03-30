<?php

    function error()
    {
        echo "ERROR\n";
    }

    if (!isset($_POST['submit']) || $_POST['submit'] !== "OK") {
        error(); return ;
    }
    if (isset($_POST['login']) && $_POST['login'] !== "")
        $login = $_POST['login'];
    else { error(); return ;}
    if (isset($_POST['oldpw']) && $_POST['oldpw'] !== "")
        $oldpasswd = hash("whirlpool", $_POST['oldpw']);
    else { error(); return ;}
    if (isset($_POST['newpw']) && $_POST['newpw'] !== "")
        $newpasswd = hash("whirlpool", $_POST['newpw']);
    else { error(); return ;}

    $array = unserialize(file_get_contents("../private/passwd"));
    $modified = false;
//    print_r($array);
    foreach ($array as $el)
    {
        if ($el['login'] === $login)
        {
            if ($el['passwd'] === $oldpasswd) {
                $el['passwd'] = $newpasswd;
                $modified = true;
            }
            else {
                error(); return ;
            }
        }
    }
    if (!$modified) {
        error(); return;
    }
    file_put_contents("../private/passwd", serialize($array));
    echo "OK\n";
?>