<?php
// Prevent direct access
if (!defined('thisismychild'))
{
	header('location: /index.php');
	exit();
}
?>
<?php include_once('./orders.php') ?>
<?php
if (isset($_POST['del_order']) && (!empty($_POST['del_order'])))
	del_order($_POST['del_order']);
?>
<?php
$notice = "";
$output = "";
if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'orders')
{
	$ORDERS_LIST = get_orders();
	if (!empty($ORDERS_LIST))
	{
		foreach ($ORDERS_LIST as $order)
		{
			$output .= "<form method='POST' action='/admin.php?view=orders' class='order'>";
			$output .= "<div class='description'>Commande <span class='highlight-more'>" . $order['id']. "</span><br/>";
			$output .= "passée par <span class='highlight'>" . $order["name"] . "</span> ";
			$output .= "le <span class='highlight'>" .  date('d/m/Y à H:i:s', $order['date']) . "</span> ";
			$output .= "pour un montant de <span class='highlight-more'>" . $order['prix_tt'] . "</span> " . CURRENCY;
			$output .= "</div>";
			$output .= "<button class='button' name='del_order' type='submit' value='" . $order['id']. "'>Supprimer la commande</button>";
			$output .= "</form>";
		}
	} else {
		$notice = "Pas de commandes :(";
	}
}
?>

<div class="orders">
	<?php echo $output; ?>
	<?php echo "<div class='notice'>" . $notice . "</div>"; ?>
</div>