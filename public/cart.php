<?php 
require_once("../resources/config.php");

if(isset($_GET['add'])) {

    $query = query("SELECT * FROM products WHERE product_id = " . escape($_GET['add']) . " ");
    confirm($query);

    while ($row = fetch_array($query)) {
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']] += 1;
        } else {
            set_message("We only have " . $row['product_quantity'] . " available");
            redirect("checkout.php");
        }
    }
    // $_SESSION['product_' . $_GET['add']] += 1;
    // redirect("index.php");
}

?>

