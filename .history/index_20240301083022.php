<?php
require_once("DataSource.php");
$db_handle = new DataSource();
?>
<HTML>

<HEAD>
    <TITLE>PHP Shopping Cart with jQuery AJAX</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    ...
</HEAD>

<BODY>
    <div id="product-grid">
        <div class="txt-heading">Products</div>
        <?php
        $product_array = $db_handle->select("SELECT * FROM tblproduct ORDER BY id ASC");
        if (!empty($product_array)) {
            foreach ($product_array as $key => $value) {
        ?>
                <div class="product-item" data-name="<?php echo $product_array[$key]["name"]; ?>" data-price="<?php echo "$" . $product_array[$key]["price"]; ?>">
                    <div class="product-image"><img class="draggable" src="<?php echo $product_array[$key]["image"]; ?>" id="<?php echo $product_array[$key]["code"]; ?>"></div>
                    <div><strong><?php echo $product_array[$key]["name"]; ?></strong></div>
                    <div class="product-price"><?php echo "$" . $product_array[$key]["price"]; ?></div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="clear-float"></div>
    <div id="shopping-cart">
        <div class="txt-heading">Shopping Cart <a id="btnEmpty" onClick="cartAction('empty','');">Empty Cart</a></div>
        <div id="cart-item"></div>
    </div>
    <script>
        $(document).ready(function() {
            cartAction('', '');
        })
    </script>
</BODY>

</HTML>