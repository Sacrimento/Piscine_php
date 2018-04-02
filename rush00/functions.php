<?php
	//Prevent direct access
	if (!defined('thisismychild'))
	{
		header('location: /index.php');
		exit();
	}
?>
<?php
function get_products()
{
	$result = array();
	$file = DATA_FOLDER . "/" . PRODUCTS_FILE;
	if (file_exists($file))
		if (file_get_contents($file))
			$result = json_decode(file_get_contents($file), true);
    return $result;
}

function get_categories()
{
	$result = array();
	$file = DATA_FOLDER . "/" . CATEGORIES_FILE;
	if (file_exists($file))
		if (file_get_contents($file))
			$result = json_decode(file_get_contents($file), true);
    return $result;
}

function get_orders()
{
	$result = array();
	$file = DATA_FOLDER . "/" . ORDERS_FILE;
	if (file_exists($file))
		if (file_get_contents($file))
			$result = json_decode(file_get_contents($file), true);
    return $result;
}

function get_users()
{
	$result = array();
	$file = DATA_FOLDER . "/" . USERS_FILE;
	if (file_exists($file))
		if (file_get_contents($file))
			$result = json_decode(file_get_contents($file), true);
    return $result;
}

function get_product($id)
{
	$products = get_products();
	foreach ($products as $product)
		if (isset($product['id']) && $product['id'] === $id)
			return $product;
	return (array());
}

function get_category($id)
{
	$categories = get_categories();
	foreach ($categories as $category)
		if (isset($category['id']) && $category['id'] === $id)
			return $category;
	return (array());
}

function get_order($id)
{
	$orders = get_orders();
	foreach ($orders as $order)
		if (isset($order['id']) && $order['id'] === $id)
			return $order;
	return (array());
}

function get_user($id)
{
	$users = get_users();
	foreach ($users as $user)
		if (isset($user['id']) && $user['id'] === $id)
			return $user;
	return (array());
}

function is_admin($name)
{
	$users = get_users();
	foreach ($users as $user)
		if (isset($user['name']) &&
			(($user['name'] === $name) && ($user['role'] === "admin")))
			return TRUE;
	return FALSE;
}
?>