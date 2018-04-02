<?php
if (!defined('thisismychild'))
{
    header('location: /index.php');
    exit();
}
?>
<?php
    include_once("./config.php");
    include_once("./panier.php");
    include_once("./functions.php");

    function create_order($requete)
    {
        update_panier($requete);
        $file = DATA_FOLDER . "/" . ORDERS_FILE;
        $panier = $_SESSION['panier'];
        $order = array(
            "id" => uniqid(),
            "name" => $_SESSION['logged_on_user'],
            "panier" => $panier,
            "prix_tt" => total_price(),
            "date" => time()
        );
        $orders = get_orders();
        $orders[] = $order;
        if (file_exists($file))
        {
            if (file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT)))
            {
                $_SESSION['panier'] = "";
                return TRUE;
            }
        }
        return TRUE;
    }

    function del_order($id)
    {
        $del = false;
        $file = DATA_FOLDER . "/" . ORDERS_FILE;
        $orders = get_orders();
        if (empty($orders))
            return FALSE;
        foreach ($orders as $key => $order)
        {
            if ($order['id'] == $id)
            {
                unset($orders[$key]);
                $del = true;
                break;
            }
        }
        if ($del === true)
            if (file_exists($file))
                if (file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT)))
                    return TRUE;
        return FALSE;
        
    }
?>