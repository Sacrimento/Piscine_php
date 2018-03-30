<?php

    function auth($login, $passwd)
    {
        if (!isset($login) || !isset($passwd) || $passwd === "" || $login === "")
            return false;
        $passwd = hash("whirlpool", $passwd);
        $array = unserialize(file_get_contents("../private/passwd"));
        foreach ($array as $elem)
        {
            if ($elem['login'] === $login && $elem['passwd'] === $passwd)
                return true;
        }
        return false;
    }

?>