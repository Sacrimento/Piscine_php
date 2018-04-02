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
function add_product($name, $description, $image, $price, $categories = array())
{
	$file = DATA_FOLDER . "/" . PRODUCTS_FILE;
    $products = get_products();
    $id = 0;
    if (!empty($products)) {
        foreach ($products as $product)
        $id = $product['id'] > $id ? $product['id'] : $id;
        $id += 1;
        $products[] = array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "image" => $image,
            "price" => $price,
            "categories" => $categories
        );
        if (file_exists($file))
            if (file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT)))
                return TRUE;
    }
    return FALSE;
}

function del_product($id)
{
    if (empty($id))
        return false;
    $products = get_products();
    $del = false;
    $file = DATA_FOLDER . "/" . PRODUCTS_FILE;
    foreach ($products as $key => $product)
    {
        if ($product['id'] == $id)
        {
            unset($products[$key]);
            $del = true;
            break;
        }
    }
    if ($del === true)
        if (file_exists($file))
    		if (file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT)))
    			return TRUE;
    return false;
}

function edit_product($id, $name, $description, $image, $price, $categories)
{
    $products = get_products();
    $modified = false;
    $file = DATA_FOLDER . "/" . PRODUCTS_FILE;
    foreach ($products as $key => $product)
    {
        if ($product['id'] == $id)
        {
            $products[$key]['price'] = $price;
            $products[$key]['name'] = $name;
            $products[$key]['image'] = $image;
            $products[$key]['description'] = $description;
            $products[$key]['categories'] = $categories;
            $modified = true;
            break;
        }
    }
    if ($modified === true)
        if (file_exists($file))
    		if (file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT)))
    			return TRUE;
    return FALSE;
}
?>