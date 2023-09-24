<?php
/**
 * Get WooCommerce Products
 *
 * @return array|null Array of product data, or null if none.
 * @since 0.0.1
 */
function get_woocommerce_products() {
    $products = [];

    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Get a list of products
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $product = wc_get_product(get_the_ID());

                // Add product data to the array
                $product_data = [
                    'id'             => $product->get_id(),
                    'name'           => $product->get_name(),
                    'price'          => $product->get_price(),
                    'description'    => $product->get_description(),
                    // Add more fields as needed
                ];

                $products[] = $product_data;
            }
            wp_reset_postdata();
        }
    }

    return $products;
}

/*
 * Register Rest API Endpoint
 * Route: {URL}/wp-json/woocommerce/v1/products
 */
add_action('rest_api_init', function () {
    register_rest_route('woocommerce/v1', '/products', array(
        'methods'  => 'GET',
        'callback' => 'get_woocommerce_products',
    ));
});
