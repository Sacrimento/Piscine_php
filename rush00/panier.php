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

    function is_valid_product($id)
    {
        $products = get_products();
        foreach ($products as $product)
            if (isset($product["id"]) && $product["id"] == $id)
                return TRUE;
        return FALSE;
    }

    function add_panier($id, $nbr)
    {
        $added = false;
        if ($nbr < 1)
           return false;
        if (!isset($_SESSION['panier']) || empty($_SESSION['panier']))
            $_SESSION['panier'] = [];
        if (is_valid_product($id) === FALSE)
            return FALSE;
        foreach ($_SESSION['panier'] as &$caddie)
        {
            if ($caddie['id'] == $id) {
                $caddie['amount'] += $nbr;
                $added = true;
                break ;
            }
        }
        if (!$added)
            $_SESSION['panier'][] = array("id" => $id, "amount" => $nbr);
    }

    function del_panier($id)
    {
        foreach ($_SESSION['panier'] as &$elem)
        {
            if ($elem['id'] == $id)
            {
                $tmp = $elem;
                $elem = $_SESSION['panier'][0];
                $_SESSION['panier'][0] = $tmp;
                array_shift($_SESSION['panier']);
                break;
            }
        }
    }

    function del_qtt_panier($id, $nbr)
    {
        $del = false;

        if ($nbr < 1)
            die("Quantite incorrecte");

        if (!isset($_SESSION['panier']))
            return FALSE;

        foreach ($_SESSION['panier'] as &$caddie)
        {
            if ($caddie['id'] == $id) {
                $caddie['amount'] -= $nbr;
                if ($caddie['amount'] <= 0)
                    del_panier($id);
            }
        }
    }

    function total_price()
    {
        $total = 0;
        $products = get_products();
        if (!isset($_SESSION['panier']) || empty($_SESSION['panier']))
            return false;
        foreach ($_SESSION['panier'] as $element_panier)
        {
            $id = $element_panier['id'];
            foreach ($products as $product)
            {
                if (isset($product['id']) && $product['id'] == $id)
                    $total += $product['price'] * $element_panier['amount'];
            }
        }
        return $total;
    }

    function refresh_amount($id, $new_amount)
    {
        if (empty($new_amount) || $new_amount == 0)
        {
            del_panier($id);
            return ;
        }
        if ($new_amount < 0)
            return ;
        $panier = isset($_SESSION['panier']) && !empty($_SESSION['panier']) ? $_SESSION['panier'] : [];
        foreach ($panier as $key => $elem_panier)
        {
            if (isset($elem_panier['id']) && $elem_panier['id'] == $id)
            {
                $panier[$key]['amount'] = $new_amount;
                $_SESSION['panier'] = $panier;
            }
        }
    }

    function update_panier($requete)
    {
        $regex = "/(?<=amount)(\d+)/";        
        foreach ($requete as $key => $amount)
            if (preg_match($regex, $key, $match))
                refresh_amount($match[0], $amount);
    }

    function total_amount()
    {
        if (!isset($_SESSION['panier']))
            return false;
        $qtt = 0;
        foreach ($_SESSION['panier'] as $elem)
            $qtt += $elem['amount'];
        return $qtt;
    }
?>