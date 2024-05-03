<?php
session_start();
require __DIR__ ."/stripefolder/init.php";

$stripe_secret_key = "sk_test_51PAprKFm4ovkZcBI6GzJVlPcFSxzQ7BdQAEDytRwPTkhXM8pDhbI0naiYdrUmk1YmMX3Aq173MGhZCzKJjtuLHXg006GVidVZn";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$lineItems = [];

foreach ($_SESSION["cart"] as $product) {
    $item_price = intval(str_replace(".", "", $product["item_price"]));
    $lineItems[] = [
        "quantity"   => $product["item_quantity"], 
        "price_data" => [ 
            "currency"     => "gbp", 
            "unit_amount"  => $item_price, 
            "product_data" => [ 
                "name"        => $product['item_id'],
                "description" => $product['item_name']
            ]
        ]
    ];
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode"        => "payment",
    "success_url" => "http://localhost/PhpAdvertsWebsite/success.php",
    "cancel_url"  => "http://localhost/PhpAdvertsWebsite/cart.php",
    "line_items"  => $lineItems
]);

http_response_code(303);
header("Location: " . $checkout_session->url);