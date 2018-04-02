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
function add_category($name)
{
	$file = DATA_FOLDER . "/" . CATEGORIES_FILE;
    $categories = get_categories();
    foreach ($categories as $category)
        if ($name == $category['name'])
            return FALSE;
    $categories[] = array(
    	"id" => uniqid(),
    	"name" => $name
    );
    if (file_exists($file))
    	if (file_put_contents($file, json_encode($categories, JSON_PRETTY_PRINT)))
    		return TRUE;
    return FALSE;
}

function del_category($id)
{
    $categories = get_categories();
    $del = false;
    $file = DATA_FOLDER . "/" . CATEGORIES_FILE;
    foreach ($categories as $key => $category)
    {
        if ($category['id'] == $id)
        {
            unset($categories[$key]);
            $del = true;
            break;
        }
    }
    if ($del === true)
        if (file_exists($file))
    		if (file_put_contents($file, json_encode($categories, JSON_PRETTY_PRINT)))
    			return TRUE;
    return false;
}

function edit_category($id, $name)
{
    $categories = get_categories();
    $modified = false;
    $file = DATA_FOLDER . "/" . CATEGORIES_FILE;
    foreach ($categories as $key => $category)
    {
        if ($category['id'] == $id)
        {
            $categories[$key]['name'] = $name;
            $modified = true;
            break;
        }
    }
    if ($modified === true)
        if (file_exists($file))
    		if (file_put_contents($file, json_encode($categories, JSON_PRETTY_PRINT)))
    			return TRUE;
    return FALSE;
}
?>