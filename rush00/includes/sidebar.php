<?php
// Prevent direct access
if (!defined('thisismychild'))
{
	header('location: /index.php');
	exit();
}
?>

<?php
	$ACTIVE_CATEGORY = -1;
	if (isset($_GET["category"]) && isset($_GET["mode"]))
		if ($_GET["mode"] === "browse")
			$ACTIVE_CATEGORY = $_GET["category"];

	$CATEGORIES_LIST = get_categories();
	$categories = "";
	foreach ($CATEGORIES_LIST as $category)
		$categories .= "<a href='/index.php?mode=browse&category=" . $category["id"]. "' class='categorie lien-categorie " . ($ACTIVE_CATEGORY == $category["id"] ? "selected" : "") . "' data-categorie='" . $category["id"] . "'>" . $category["name"] . "</a>";
?>

<div class="sidebar">
	<div class="title">
		Catégories
	</div>
	<div class="categories">
		<?php echo "<a href='/index.php' class='categorie lien-categorie " . ($ACTIVE_CATEGORY == -1 ? "selected" : "") . "''>Tous les articles</a>"; ?>
		<?php echo $categories; ?>
	</div>
</div>