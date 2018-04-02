<?php
// Prevent direct access
if (!defined('thisismychild'))
{
	header('location: /index.php');
	exit();
}
?>
<?php include_once('./categories.php'); ?>
<?php
if (isset($_POST))
{
	if (
		(isset($_POST['add_category']) && $_POST['add_category'] === "OK")
		&& isset($_POST['name']))
	{
		if (add_category($_POST['name']) === FALSE)
			echo "ERROR: Category name exists !";
	}
	if (isset($_POST['id']))
	{
		if ((isset($_POST['del_category']) && $_POST['del_category'] === "OK"))
		{
			if (del_category($_POST['id']) === FALSE)
				echo "ERROR";
		}
		if (
			(isset($_POST['edit_category']) && $_POST['edit_category'] === "OK")
			&& isset($_POST['id']))
		{
			if (edit_category($_POST['id'], $_POST['name']) === FALSE)
				echo "ERROR";
		}
	}
}
?>
<?php
$output = "";
if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'categories')
{
	$category_LIST = get_categories();
	if (!empty($category_LIST))
	{
		foreach ($category_LIST as $category)
		{
			$output .= "<form name='add_category' action='/admin.php?view=categories' method='POST'>";
			$output .= "<span>Catégorie [" . $category['id'] . "] </span>";
			$output .= "<input type='hidden' name='id' value='" . $category['id'] . "' />";
			$output .= "<input type='text' name='name' placeholder='Nom' value='" . $category["name"] . "' required/>";
			$output .= "<button type='submit' name='edit_category' value='OK' class='button'>📝 Modifier</button>";
			$output .= "<button type='submit' name='del_category' value='OK' class='button'>⚠️ Supprimer</button>";
			$output .= "</form>";
		}
	}
}
?>

<div class="categories">
	<?php echo $output; ?>

	<form name="add_category" action="/admin.php?view=categories" method="POST">
		<input type="text" name="name" placeholder="Nom" value="" required/>
		<button type="submit" name="add_category" value="OK" class="button">Ajouter</a>
	</form>
</div>

