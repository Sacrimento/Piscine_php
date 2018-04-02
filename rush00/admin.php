<?php
    session_start();
    define('thisismychild', TRUE);
    include_once('./config.php');
    include_once('./functions.php');
?>
<?php
    if (empty($_SESSION['logged_on_user']))
    {
        header('location: /index.php');
        exit();
    }
    if (!empty($_SESSION['logged_on_user']) && is_admin($_SESSION['logged_on_user']) === FALSE)
    {
        header('location: /index.php');
        exit();
    }
?>
<?php include('./includes/header.php') ?>
<?php include('./includes/navbar.php') ?>

<?php
$actions = array(
    array(
      "view" => "users",
      "name" => "View users"
  ),
    array(
      "view" => "orders",
      "name" => "View orders"
  ),
    array(
      "view" => "products",
      "name" => "View products"
  ),
    array(
      "view" => "categories",
      "name" => "View categories"
  )
);
$output = "";
$ACTIVE_VIEW = isset($_GET['view']) && !empty($_GET['view']) ? $_GET['view'] : NULL;
foreach ($actions as $key => $action) {
    $output .= "<a class='action " . ($ACTIVE_VIEW == $action["view"] ? "selected" : "") . "' href='/admin.php?view=" . $action["view"] . "'>" . $action["name"] . "</a>";
}
?>
<main>
  <section class="masthead">
    </section>
    <section id="container">
        <div id="content" class="admin">
            <div class="sidebar">
                <div class="page-title">
                    Admin
                </div>
                <div class="sidebar actions">
                    <? echo $output; ?>
                </div>
            </div>
            <div name='admin' class="list">
                <?php 
                if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'users')
                    include('./includes/admin_users.php');
                else if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'products')
                    include('./includes/admin_products.php');
                else if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'orders')
                    include('./includes/admin_orders.php');
                else if (isset($_GET) && isset($_GET['view']) && $_GET['view'] === 'categories')
                    include('./includes/admin_categories.php');
                else
                    echo "Welcome admin";
                ?>
            </div>
        </div>
    </section>
</main>
<?php include('./includes/footer.php') ?>