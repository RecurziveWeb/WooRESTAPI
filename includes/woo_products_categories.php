<?php
/**
 * Get WooCommerce Product Categories
 *
 * @return array|null Array of product category data, or null if none.
 * @since 0.0.1
 */
function get_woocommerce_product_categories() {
    $product_categories = [];

    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Get product categories
        $args = array(
            'taxonomy'   => 'product_cat',
            'hide_empty' => false, // Set to true to hide empty categories
        );

        $categories = get_terms($args);

        if (!is_wp_error($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                // Add category data to the array
                $category_data = [
                    'id'          => $category->term_id,
                    'name'        => $category->name,
                    'slug'        => $category->slug,
                    'description' => $category->description,
                    'image'       => $category->image,  
                ];

                $product_categories[] = $category_data;
            }
        }
    }

    return $product_categories;
}

/*
 * Register Rest API Endpoint
 * Route: {URL}/wp-json/woocommerce/v1/product-categories
 */
function register_woocommerce_categories_api_endpoint() {
    register_rest_route('woocommerce/v1', '/product-categories', array(
        'methods'  => 'GET',
        'callback' => 'get_woocommerce_product_categories',
    ));
}

add_action('rest_api_init', 'register_woocommerce_categories_api_endpoint');
