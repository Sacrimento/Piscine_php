<?php
// Prevent direct access
if (!defined('thisismychild'))
{
	header('location: /index.php');
	exit();
}
?>
<?php
	include ('./user.php');
?>
<?php
$output = "";
$roles = array("admin", "user");
if (isset($_POST))
{
	if (
		(isset($_POST['add_user']) && $_POST['add_user'] === "OK")
		&& isset($_POST['login'])
		&& isset($_POST['passwd'])
		&& isset($_POST['role']))
	{
		if (add_user($_POST['login'], $_POST['passwd'], $_POST['role']) === FALSE)
			echo "ERROR";
	}
	if (((isset($_POST['id']) && $_POST['id'] !== "-1")))
	{
		if (
			(isset($_POST['del_user']) && $_POST['del_user'] === "OK")
			&& isset($_POST['id']))
		{
			if (del_user($_POST['id']) === FALSE)
				echo "ERROR";
		}
		if (
			(isset($_POST['edit_user']) && $_POST['edit_user'] === "OK")
			&& isset($_POST['id']))
		{
			if (modify_user($_POST['id'], $_POST['login'], $_POST['passwd'], $_POST['role']) === FALSE)
				echo "ERROR";
		}
	}
}
if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'users')
{
	$USERS_LIST = get_users();
	foreach ($USERS_LIST as $user)
	{
		$output .= "<form name='add_user' action='/admin.php?view=users' method='POST'>";
		$output .= "<input type='hidden' name='id' value='" . $user['id'] . "' />";
		$output .= "<input type='text' name='login' placeholder='Login' value='" . $user["name"] . "' required/>";
		$output .= "<input type='password' name='passwd' placeholder='Mot de passe' value=''/>";
		$output .= "<select name='role' required>";
		foreach ($roles as $role){
			$output .= "<option value='" . $role . "' ". ($role === $user['role'] ? "selected='selected'" : ""). ">" . $role . "</option>";
		}
		$output .= "</select>";
		$output .= "<button type='submit' name='edit_user' value='OK' class='button'>📝 Modifier</button>";
		$output .= "<button type='submit' name='del_user' value='OK' class='button'>⚠️ Supprimer</button>";
		$output .= "</form>";
	}
}
?>

<?php echo $output; ?>

<form name="add_user" action="/admin.php?view=users" method="POST">
	<input type="text" name="login" placeholder="Login" value="" required/>
	<input type="password" name="passwd" placeholder="Mot de passe" value="" required/>
	<select name='role' required>
	<?php
	foreach ($roles as $role){
		echo "<option value='" . $role . "' ". ($role === 'user' ? "selected='selected'" : ""). ">" . $role . "</option>";
	}
	?>
	</select>
	<button type="submit" name="add_user" value="OK" class="button">Ajouter</button>
</form>