<section>
    <h2>Shopping cart</h2>
    <?php

    function getBy($att, $value, $array)
    {
        foreach ($array as $key) {
            if ($key[0] == $value) {
                return $key;
            }
        }
        return null;
    }

    $totalPrice = 0;
    $product="";
    $count="";
    $price="";
    foreach ($_SESSION["cart"] as $key => $value) {

        $item = getBy("id", $key, $catalog);
        $totalPrice = $totalPrice + ($value["quantity"] * $item["price"]);
        $product = $product  . $item["id"]. ";";
        $count = $count  . $value["quantity"] . ";";
        $price = $price  . $item["price"]. ";";
        echo '
<div class="cart-item">
<div class="cart-img">
' . $item["img"] . '
</div>
<div>
' . $item["name"] . '
</div>
<div class="cart-control">
<div class="cart-price">
' . $item["price"] . '
</div>
<div class="cart-quantity">
' . ($value["quantity"]) . '
</div>
<div class="cart-quantity">
' . ($value["quantity"] * $item["price"]) . '
</div>
<a href="/?action=add&id=' . $item["id"] . '" class="cart-button">
+
</a>
<a href="/?action=remove&id=' . $item["id"] . '" class="cart-button">
-
</a>
<a href="/?action=delete&id=' . $item["id"] . '" class="cart-button">
x
</a>
</div>
</div>';

    }

    echo "<div id='cart-total-price'>Total price: $totalPrice</div>";

    ?>
</section>
<section>
    <div>
        <form method="post" id="formOdeslat" action="index.php?action=odeslat" enctype="multipart/form-data">
            <?php
            echo '<input name="product" type="hidden" value='.$product.'>';
            echo '<input name="count" type="hidden" value='.$count.'>';
            echo '<input name="price" type="hidden" value='.$price.'>';
            ?>
            <button type="submit">Odeslat</button>
        </form>
    </div>
</section>