<?php
    session_start();
    if (isset($_SESSION['logged_on_user']))
        unset($_SESSION['logged_on_user']);

?>