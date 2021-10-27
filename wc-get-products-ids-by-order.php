<?php

// the order can have payment for multiple products in cart

// woocommerce_order_status_completed
add_action( 'woocommerce_payment_complete', 'so_payment_complete' );
function so_payment_complete($order_id)
{
    $order = wc_get_order($order_id);
    $billingEmail = $order->billing_email;
    $billingName = $order->billing_first_name;

    $items = $order->get_items();

    foreach ( $items as $item ) {
        $product_name = $item->get_name();
        $product_id = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();
        if ($product_id == 980) {
            // ....
        }
    }
}
