<?php
    session_start();
    define('thisismychild', TRUE);
    include_once('./config.php');
    include_once('./functions.php');
?>
<?php
include_once('./user.php');

$notice_signin = "";
$notice_signup = "";
if (empty($_SESSION['logged_on_user']))
{
	if (isset($_GET) && $_GET['action'] && $_GET['action'] === "sign_in")
	{
		if (check_credentials($_POST['login'], $_POST['passwd']) === TRUE)
		{
			$_SESSION['logged_on_user'] = $_POST['login'];
			header('location: /index.php');
			exit();
		} else {
			$_SESSION['logged_on_user'] = "";
			$notice_signin .= "Mauvais identifiants.\n";
		}
	}
	if (isset($_GET) && $_GET['action'] && $_GET['action'] === "sign_up")
	{
		if ($_POST['passwdverif'] === $_POST['passwd'])
		{
			if (add_user($_POST['login'], $_POST['passwd'], 'user') === TRUE)
			{
				if (check_credentials($_POST['login'], $_POST['passwd']) === TRUE)
				{
					$_SESSION['logged_on_user'] = $_POST['login'];
					header('location: /index.php');
					exit();
				}
			} else {
				$notice_signup = "Nom d'utilisateur non disponible<br/>ou vos identifiants ne correspondent pas\n";
			}
		}
		else {
			$notice_signup = "Les mots de passe ne correspondent pas\n";
		}
	}
} else {
	header('location: /index.php');
	exit();
}

?>
<?php include('./includes/header.php') ?>
<?php include('./includes/navbar.php') ?>
<main>
	<section class="masthead">
	</section>
	<section id="container">
		<div id="content" class="loginforms">
			<div class="page-title">
				CONNEXION
			</div>
			<div class="forms">
					<div class="signin">
					<div class="title">
						Se connecter
					</div>
					<form id="signin" action="./signin.php?action=sign_in" method="POST">
						<input type="text" name="login" placeholder="Nom d'utilisateur" value="" required/>
						<input type="password" name="passwd" placeholder="Mot de passe" value="" required/>
						<?php echo $notice_signin; ?>
						<button type="submit" name="sign_in" value="OK" />Se connecter</button>
					</form>
				</div>
				<div class="signup">
					<div class="title">
						Créer un compte
					</div>
					<form id="signup" action="./signin.php?action=sign_up" method="POST">
						<input type="text" name="login" placeholder="Login en lettres et chiffres uniquement!" value="" required/>
						<input type="password" name="passwd" placeholder="Mot de passe" value="" required/>
						<input type="password" name="passwdverif" placeholder="Vérifier le mot de passe" value="" required/>
						<?php echo $notice_signup; ?>
						<button type="submit" name="sign_up" value="OK" />S'enregistrer</button>
					</form>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include('./includes/footer.php') ?>