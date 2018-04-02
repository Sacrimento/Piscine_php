<?php
    session_start();
    if (isset($_GET['submit']) && $_GET['submit'] === "OK")
    {
        if (isset($_GET['login']) && isset($_GET['passwd'])) {
            $_SESSION['login'] = $_GET['login'];
            $_SESSION['passwd'] = $_GET['passwd'];
        }
    }
?>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <form method="get" action="index.php">
        Identifiant: <input type="text" name="login" value="<?php echo $_SESSION['login'] ?>"><br/>
        Mot de passe: <input type="text" name="passwd" value="<?php echo $_SESSION['passwd']?>"><br/>
        <input type="submit" name="submit" value="OK">
    </form>
</body>
</html>