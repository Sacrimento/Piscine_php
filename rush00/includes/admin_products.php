<?php
// Prevent direct access
if (!defined('thisismychild'))
{
	header('location: /index.php');
	exit();
}
?>
<?php include_once('./products.php'); ?>
<?php
if (isset($_POST))
{
	
	if ((isset($_POST['add_product']) && $_POST['add_product'] === "OK") && isset($_POST['name'])
			&& isset($_POST['description']) && isset($_POST['price']) && isset($_POST['image']))
		if (add_product($_POST['name'], $_POST['description'], $_POST['image'], $_POST['price'], $_POST['categories']) === FALSE)
			echo "ERROR";
	if (isset($_POST['id']))
	{
		if (
			(isset($_POST['del_product']) && $_POST['del_product'] === "OK")
			&& isset($_POST['id']))
		{
			if (del_product($_POST['id']) === FALSE)
				echo "ERROR";
		}
		if (
			(isset($_POST['edit_product']) && $_POST['edit_product'] === "OK")
			&& isset($_POST['id']))
		{
			if (edit_product($_POST['id'], $_POST['name'], $_POST['description'], $_POST['image'], $_POST['price'], $_POST['categories']) === FALSE)
				echo "ERROR";
		}
	}
}
?>
<?php
$output = "";
if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'products')
{
	$PRODUCT_LIST = get_products();
	$CATEGORIES_LIST = get_categories();
	if (!empty($PRODUCT_LIST))
	{
		foreach ($PRODUCT_LIST as $product)
		{
			$output .= "<form name='add_product' action='/admin.php?view=products' method='POST' class='product'>";
			$output .= "<div class='entries'>";
			$output .= "<div class='row'>";
			$output .= "<input type='hidden' name='id' value='" . $product['id'] . "' />";
			$output .= "<input type='text' name='name' placeholder='Nom' value='" . $product["name"] . "' required/>";
			$output .= "<input type='text' name='description' placeholder='Description' value='" . $product["description"] . "' required/>";
			$output .= "<input type='url' name='image' placeholder='Lien Image' value='" . $product["image"] . "' required/>";
			$output .= "<input type='number' name='price' placeholder='Prix' step='0.01' min='0.00' value='" . $product["price"] . "' required/>";
			$output .= "</div>";
			$output .= "<div class='row checkboxes'>";
			$output .= "<span class='note'>Catégories:</span>";
			if (!empty($CATEGORIES_LIST)){
				foreach ($CATEGORIES_LIST as $category) {
					$match = 0;
					$output .= "<div class='checkbox'><input type='checkbox' name='categories[]' value='" . $category['id'] . "' ";
					if (isset($product['categories']) && !empty($product['categories']))
					{
						foreach($product['categories'] as $product_cat)
							if ($product_cat == $category['id'])
								$match = 1;
						$output .= $match === 1 ? "checked" : "";
					}
					$output .= "/>" . $category['name'] . "</div>";
				}
			}
			$output .= "</div>";
			$output .= "</div>";
			$output .= "<div class='actions'>";
			$output .= "<button type='submit' name='edit_product' value='OK' class='button'>📝 Modifier</button>";
			$output .= "<button type='submit' name='del_product' value='OK' class='button'>⚠️ Supprimer</button>";
			$output .= "</div>";
			$output .= "</form>";
		}
	}
}
?>

<div class="products">
	<?php echo $output; ?>

	<form name="add_product" action="/admin.php?view=products" method="POST" class='product'>
		<div class="entries">
			<div class="row">
				<input type="text" name="name" placeholder="Nom" value="" required/>
				<input type="text" name="description" placeholder="Description" value="" required/>
				<input type="url" name="image" placeholder="URL Image" value="" required/>
				<input type='number' min="0.00" step='0.01' name="price" placeholder="Prix" value="" required/>
			</div>
			<div class="row checkboxes">
				<span class='note'>Catégories:</span>
			<?php
			foreach ($CATEGORIES_LIST as $category)
				echo "<div class='checkbox'><input type='checkbox' name='categories[]' value='" . $category['id'] . "' />" . $category['name'] . "</div>"; 
			?>

			</div>
		</div>
		<div class="actions">
			<button type="submit" name="add_product" value="OK" class="button">Ajouter</a>
		</div>
	</form>
</div>