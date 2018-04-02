<?php
define('thisismychild', TRUE);
if (!isset($_SESSION))
  session_start();
?>
<?php include_once('./config.php') ?>
<?php include_once('./functions.php') ?>
<?php include_once('./panier.php') ?>
<?php include_once('./orders.php') ?>
<?php
$orderstatus = 0;
if (isset($_GET['update_cart']) && $_GET['update_cart'] === 'OK')
    update_panier($_GET);
if (isset($_GET['order_pass']) && $_GET['order_pass'] === 'OK')
{
    if (isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] !== "")
    {
        create_order($_GET);
        $orderstatus = 1;
    } else {
        header('location: /signin.php');
        exit();
    }
}
$panier = isset($_SESSION['panier']) && !empty($_SESSION['panier']) ? $_SESSION['panier'] : NULL;
$cart = "";
$total = 0;
if ($panier)
{
    foreach($panier as $element_panier)
    {
      $product = get_product($element_panier['id']);
      $subtotal = $product["price"] * $element_panier["amount"];
      $cart .= "<div class='item'>";
      $cart .= "<div class='product'>";
      $cart .= "<div class='image'><img src='" . $product["image"] . "'/></div>";
      $cart .= "<div class='meta'>";
      $cart .= "<div class='title'>" . $product["name"] . "</div>";
      $cart .= "<div class='description'>" . $product["description"] . "</div>";
      $cart .= "</div>";
      $cart .= "</div>";
      $cart .= "<div class='actions'>";
      $cart .= "<div class='amount'>";
      $cart .= "Quantité <input type='number' name='amount" . $product['id'] . "' value='" . (int)$element_panier['amount'] . "' min='0' max='200' />";
      $cart .= "</div>";
      $cart .= "</div>";
      $cart .= "<div class='price'>";
      $cart .= "<span>" . $subtotal . " " . CURRENCY . "</span>";
      $cart .= "</div>";
      $cart .= "</div>";
      $total += $subtotal;
  }
}
?>
<?php include('./includes/header.php') ?>
<?php include('./includes/navbar.php') ?>
<main>
    <section class="masthead">
    </section>
    <section id="container">
        <div id="content" class="cart">
            <div class="page-title">
            Panier
            </div>
            <form action='/cart.php' name='cart' method='GET' class="list">
                <div class="items">
                  <?php echo $cart; ?>
              </div>
              <div class="buttons">
                <?php 
                if (isset($_SESSION['panier']) & !empty($_SESSION['panier'])) :
                    ?>

                    <div class="update">
                        <button type="submit" name="update_cart" value="OK" role="button" class="" value="update">Mettre à jour le panier</button>
                    </div>
                    <div class="total">
                        <?php echo $total . " " . CURRENCY; ?>
                    </div>
                    <div class="proceed">
                        <button type="submit" name="order_pass" value="OK" role="button">Passer commande</button>
                    </div>
                <?php else : ?>
                    <?php if ($orderstatus === 1): ?>
                        <div class="notice">Merci pour votre commande!</div>
                    <?php else: ?>
                        <div class="notice">Panier vide! 🌝</div>
                    <?php endif; ?>
              <?php endif; ?>
          </form>
        </div>
    </section>
</main>
<?php include('./includes/footer.php') ?>