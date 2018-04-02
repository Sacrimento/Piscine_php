<?php
    // if included by other known page
    if (defined('thisismychild'))
    {
        header('location: /index.php');
        exit();
    }
?>
<?php
    include_once('./config.php');

    function install_database($products_data, $categories_data, $users_data, $orders_data) {
        $folder = DATA_FOLDER;
        $products = DATA_FOLDER . "/" . PRODUCTS_FILE;
        $orders = DATA_FOLDER . "/" . ORDERS_FILE;
        $categories = DATA_FOLDER . "/" . CATEGORIES_FILE;
        $users = DATA_FOLDER . "/" . USERS_FILE;

        $output = "<p>";

        if(!file_exists($folder))
        {
            if (mkdir($folder, 0777) === FALSE)
            {
                echo "ERROR: Can't create database file!<br/>\n";
                return FALSE;
            }
            $output .=  "Created folder [" . DATA_FOLDER . "] !<br/>\n";
        } else {
            $output .=  "Folder [" . $folder . "] already created !<br/>\n";
        }

        if (!file_exists($products)){
            $file = fopen($products, "w");
            if (file_put_contents($products, $products_data) === FALSE)
            {
                echo "ERROR: Can't create products file! as [" . $folder . "]<br/>\n";
                fclose($file);
                return FALSE;
            }
            fclose($file);
            $output .=  "Created file [" . $products . "] ! and added provided initial data!<br/>\n";
        }
        else {
            $output .=  "File [" . $products . "] already created !<br/>\n";
        }

        if (!file_exists($categories)){
            $file = fopen($categories, "w");
            if (file_put_contents($categories, $categories_data) === FALSE)
            {
                echo "ERROR: Can't create categories file! as [" . $categories . "]<br/>\n";
                fclose($file);
                return FALSE;
            }
            fclose($file);
            $output .=  "Created file [" . $categories . "] !<br/>\n";
        } else {
            $output .=  "File [" . $categories . "] already created !<br/>\n";
        }

        if (!file_exists($users)){
            $file = fopen($users, "w");
            if (file_put_contents($users, $users_data) === FALSE)
            {
                echo "ERROR: Can't create users file! as [" . $users . "]<br/>\n";
                fclose($file);
                return FALSE;
            }
            fclose($file);
            $output .=  "Created file [" . $users . "] !<br/>\n";
        } else {
            $output .=  "File [" . $users . "] already created !<br/>\n";
        }

        if (!file_exists($orders)){
            $file = fopen($orders, "w");
            if (file_put_contents($orders, $orders_data) === FALSE)
            {
                echo "ERROR: Can't create orders file! as [" . $orders . "]<br/>\n";
                fclose($file);
                return FALSE;
            }
            fclose($file);
            $output .=  "Created file [" . $orders . "] !<br/>\n";
        } else {
            $output .=  "File [" . $orders . "] already created !<br/>\n";
        }

        $output .=  "Everything looks good, go see the website!<br/>\n";
        $output .= "To reset everything, delete the [" . $folder . "] folder (no turning back tho).</p>\n";
        $output .= "<a href='/' title='Go to Website'>Go to website</a>\n";
        echo $output;
        return TRUE;
    }

    $uniqids = array (
        uniqid(),
        uniqid(),
        uniqid(),
        uniqid()
    );
    $products_data = array(
        array (
            "id" => 12,
            "categories" => array($uniqids[0]),
            "name" => "Curry de poulet",
            "description" => "lorem ipsum",
            "image" => "http://lorempixel.com/600/600/food/1/",
            "price" => 0.22
        ),
        array (
            "id" => 1,
            "categories" => array($uniqids[0], $uniqids[1]),
            "name" => "Brochettes de veau",
            "description" => "dolor sit amet",
            "image" => "http://lorempixel.com/600/600/food/2/",
            "price" => 33
        ),
        array (
            "id" => 2,
            "categories" => array($uniqids[0], $uniqids[1], $uniqids[2]),
            "name" => "Trucs sur un truc",
            "description" => "dolor sit amet",
            "image" => "http://lorempixel.com/600/600/food/3/",
            "price" => 33
        ),
        array (
            "id" => 3,
            "categories" => array($uniqids[1]),
            "name" => "Bento",
            "description" => "dolor sit amet",
            "image" => "http://lorempixel.com/600/600/food/4/",
            "price" => 33
        ),
        array (
            "id" => 4,
            "categories" => array($uniqids[1], $uniqids[2]),
            "name" => "Écouteurs",
            "description" => "dolor sit amet",
            "image" => "http://lorempixel.com/600/600/technics/5/",
            "price" => 33
        ),
        array (
            "id" => 5,
            "categories" => array($uniqids[2]),
            "name" => "Casque",
            "description" => "dolor sit amet",
            "image" => "http://lorempixel.com/600/600/technics/6/",
            "price" => 33
        )
    );

    $categories_data = array(
        array (
            "id" => $uniqids[0],
            "name" => "Cool"
        ),
        array (
            "id" => $uniqids[1],
            "name" => "Moyen Cool"
        ),
        array (
            "id" => $uniqids[2],
            "name" => "Pas top"
        )
    );

    $users_data = array(
        array (
            "id" => "-1",
            "name" => "admin",
            "passwd" => hash('whirlpool', 'admin'),
            "role" => "admin"
        ),
        array (
            "id" => uniqid(),
            "name" => "zaz",
            "passwd" => hash('whirlpool', 'jaimelespetitsponeys'),
            "role" => "user"
        )
    );

    $orders_data = array(
        array (
            "id" => uniqid(),
            "name" => "admin",
            "panier" => array(
                "id" => 0,
                "amount" => 4
            ),
            "prix_tt" => 0.88,
            "date" => time() - 500
        ),
        array (
            "id" => uniqid(),
            "name" => "zaz",
            "panier" => array(
                array(
                    "id" => 1,
                    "amount" => 60
                ),
                array(
                    "id" => 0,
                    "amount" => 6
                )
            ),
            "prix_tt" => 66,
            "date" => time()
        ),
        array (
            "id" => uniqid(),
            "name" => "toto",
            "panier" => array(
                "id" => 2,
                "amount" => 1
            ),
            "prix_tt" => 60,
            "date" => time() - 5000
        )
    );

    install_database(
        json_encode($products_data, JSON_PRETTY_PRINT),
        json_encode($categories_data, JSON_PRETTY_PRINT),
        json_encode($users_data, JSON_PRETTY_PRINT),
        json_encode($orders_data, JSON_PRETTY_PRINT)
    );
?>