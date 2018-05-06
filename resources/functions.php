<?php 
// Helper Functions
function redirect($location) {
    header("Location: $location");
}

function query($sql) {
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result) {
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

function escape($string) {
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result) {
    return mysqli_fetch_array($result);
}



/**********FRONT END FUNCTIONS ********************/
// Get Products

function get_products() {
    $query = query("SELECT * FROM products");
    confirm($query);
    while($row = fetch_array($query)) {
        $product = <<<DELIMETER
        <div class="col-sm-4 col-lg-4 col-md-4">
            <a href="item.php?id={$row['product_id']}"><div class="thumbnail">
                <img src="{$row['product_image']}" alt=""></a>
                <div class="caption">
                    <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                    <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                    </h4>
                    <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to Cart</a>
                </div>
                <!-- <div class="ratings">
                    <p class="pull-right">15 reviews</p>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                    </p>
                </div> -->
            </div>
        </div>

DELIMETER;
    echo $product;
    }
}


function get_categories() {
    $query = query("SELECT * FROM categories ");
    confirm($query);

    while ($row = fetch_array($query)) {
        $category_links = <<<DELIMETER
        <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;
    echo $category_links;
    }
}


function get_products_in_cat_page() {
    $query = query("SELECT * FROM products WHERE product_category_id = " . escape($_GET['id']) . " ");
    confirm($query);
    while($row = fetch_array($query)) {
        $product = <<<DELIMETER
        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;
    echo $product;
    }
}


/*********************BACK END FUNCTIONS ****************/
?>