<?php 
require_once("../resources/config.php");
require_once("cart.php");
include(TEMPLATE_FRONT . DS . "header.php");

if(isset($_GET['tx'])) {
    $amount = $_GET['amt'];
    $currency = $_GET['cc'];
    $transaction = $_GET['tx'];
    $status = $_GET['st'];
} else {
    redirect("index.php");
}
?>

<!-- Page Content -->
<div class="container">
    <h1 class="text-center">THANK YOU</h1>


</div>
<!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>