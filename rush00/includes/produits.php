<?php
	// Prevent direct access
	if (!defined('thisismychild'))
	{
		header('location: /index.php');
		exit();
	}
?>
<?php 
include_once('./panier.php');

foreach ($_GET as $key => $value)
{
	if ($key === 'action' && $value === 'add_product')
	{
		add_panier((int)$_GET['id'], (int)$_GET['amount']);
		break ;
	}
}
?>
<?php
	$ACTIVE_CATEGORY = -1;
	if (isset($_GET["category"]) && isset($_GET["mode"]))
		if ($_GET["mode"] === "browse")
			$ACTIVE_CATEGORY = $_GET["category"];
	$products = "";
	$PRODUCT_LIST = get_products();
	$baseParams = $ACTIVE_CATEGORY !== -1 ? "mode=browse&category=" . $_GET["category"] . "&" : "";
	if ($ACTIVE_CATEGORY === -1)
	{
		$ids = array();
		foreach ($PRODUCT_LIST as $product)
		{
			if (isset($product['categories']) && !isset($ids[(string)$product['id']]))
			{
				$products .= "<div class='blocproduit'>";
				$products .= "<div class='image'>";
				$products .= "<figure><img src='" . $product["image"]. "' alt=''></figure></div>";
				$products .= "<div class='content'>";
				$products .= "<div class='meta'><div class='titre'>" . $product["name"] . " " . $product["price"] . CURRENCY . "</div><div class='description'>" . $product["description"] . "</div></div>";
				$products .= "<div class='action'><a href='/index.php?" . $baseParams . "action=add_product&id=" . $product['id'] . "&amount=1' role='button'><svg class='cart-plus' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512'><path d='M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z'/></svg></a></div>";
				$products .= "</div></div>";
			}
			$ids[(string)$product['id']] = 'already showed';
		}
	}
	else {
		foreach ($PRODUCT_LIST as $product)
		{
			if (isset($product['categories']))
			{
				foreach ($product['categories'] as $category)
				{
					if ($ACTIVE_CATEGORY == $category)
					{
						$products .= "<div class='blocproduit'>";
						$products .= "<div class='image'>";
						$products .= "<figure><img src='" . $product["image"]. "' alt=''></figure></div>";
						$products .= "<div class='content'>";
						$products .= "<div class='meta'><div class='titre'>" . $product["name"] . " " . $product["price"] . CURRENCY . "</div><div class='description'>" . $product["description"] . "</div></div>";
						$products .= "<div class='action'><a href='/index.php?" . $baseParams . "action=add_product&id=" . $product['id'] . "&amount=1' role='button'><svg class='cart-plus' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 576 512'><path d='M504.717 320H211.572l6.545 32h268.418c15.401 0 26.816 14.301 23.403 29.319l-5.517 24.276C523.112 414.668 536 433.828 536 456c0 31.202-25.519 56.444-56.824 55.994-29.823-.429-54.35-24.631-55.155-54.447-.44-16.287 6.085-31.049 16.803-41.548H231.176C241.553 426.165 248 440.326 248 456c0 31.813-26.528 57.431-58.67 55.938-28.54-1.325-51.751-24.385-53.251-52.917-1.158-22.034 10.436-41.455 28.051-51.586L93.883 64H24C10.745 64 0 53.255 0 40V24C0 10.745 10.745 0 24 0h102.529c11.401 0 21.228 8.021 23.513 19.19L159.208 64H551.99c15.401 0 26.816 14.301 23.403 29.319l-47.273 208C525.637 312.246 515.923 320 504.717 320zM408 168h-48v-40c0-8.837-7.163-16-16-16h-16c-8.837 0-16 7.163-16 16v40h-48c-8.837 0-16 7.163-16 16v16c0 8.837 7.163 16 16 16h48v40c0 8.837 7.163 16 16 16h16c8.837 0 16-7.163 16-16v-40h48c8.837 0 16-7.163 16-16v-16c0-8.837-7.163-16-16-16z'/></svg></a></div>";
						$products .= "</div></div>";
					}
				}
			}
		}
	}
?>
<main>
	<section class="masthead">
	</section>
	<section id="container">
		<div id="sidebar">
			<?php include('./includes/sidebar.php'); ?>
		</div>
		<div id="content" class="produits">
			<?php echo $products; ?>
		</div>
	</section>
</main>