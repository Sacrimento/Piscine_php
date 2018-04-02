<?php
if (!defined('thisismychild'))
{
    header('location: /index.php');
    exit();
}
?>
<?php
include_once("./config.php");
include_once("./functions.php");
?>
<?php

function add_user($login, $passwd, $role)
{
    $regex = "/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/";
    if (empty($login) ||
        empty($passwd) ||
        empty($role) ||
        !preg_match($regex, $login))
        return FALSE;
    $users = get_users();
    foreach ($users as $user){
        if ($user['name'] === $login){
            return false;
        }
    }
    $users[] = array(
        "id" => uniqid(),
        "name" => $login,
        "passwd" => hash('whirlpool', $passwd),
        "role" => $role
    );
    if (@file_put_contents(DATA_FOLDER . "/" . USERS_FILE, json_encode($users, JSON_PRETTY_PRINT)))
        return TRUE;
    else
        return FALSE;
}

function del_user($id)
{
    if (empty($id))
        return false;
    $users = get_users();
    $del = false;
    foreach ($users as $key => $user)
    {
        if ($user['id'] == $id)
        {
            unset($users[$key]);
            $del = true;
            break;
        }
    }
    if ($del === true)
    {
        if (@file_put_contents(DATA_FOLDER . "/" . USERS_FILE, json_encode($users, JSON_PRETTY_PRINT)))
            return TRUE;
        else
            return FALSE;
    }
    else
        return false;
}

function modify_user($id, $login, $passwd, $role)
{
    $users = get_users();

    if (empty($login) || empty($role))
        return false;
    $newpasswd = hash("whirlpool", $passwd);
    $modified = false;
    foreach ($users as $key => $user)
    {
        if ($user['id'] === $id)
        {
            $users[$key]['name'] = empty($login) ? $users[$key]['name'] : $login;
            $users[$key]['passwd'] = empty($passwd) ? $users[$key]['passwd'] : $newpasswd;
            $users[$key]['role'] = $role;
            $modifed = true;
            break;
        }
    }
    if ($modifed === true)
    {
        if (@file_put_contents(DATA_FOLDER . "/" . USERS_FILE, json_encode($users, JSON_PRETTY_PRINT)))
            return TRUE;
        else
            return FALSE;
    }
    return FALSE;
}

function check_credentials($login, $passwd)
{
    if (empty($passwd) || empty($login))
        return false;
    $passwd = hash("whirlpool", $passwd);
    $users = get_users();
    foreach ($users as $user)
        if ($user['name'] === $login && $user['passwd'] === $passwd)
            return true;
    return false;
}

function logout()
{
    $_SESSION['logged_on_user'] = "";
    $_SESSION['panier'] = "";
}

?>