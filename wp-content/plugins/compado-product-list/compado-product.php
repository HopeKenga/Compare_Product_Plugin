<?php
/**
 * Plugin Name: Compado Product Display
 * Description: Display products from Compado API.
 * Version: 1.0
 * Author: Hope Kenga
 * Text Domain: compado-product-display
 */

defined('ABSPATH') or die('Direct script access disallowed.');

// Include API class and settings page
include_once plugin_dir_path(__FILE__) . 'class-compado-api.php';
include_once plugin_dir_path(__FILE__) . 'includes/compado-settings.php';

// Function to enqueue scripts and styles
function compado_enqueue_scripts() {
    wp_enqueue_style('compado-plugin-style', plugins_url('css/main.css', __FILE__));
    wp_enqueue_script('compado-plugin-script', plugins_url('js/script.js', __FILE__), array('jquery'), null, true);

    wp_localize_script('compado-plugin-script', 'compadoAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('compado-ajax-nonce')
    ));
}

// Register the script and style enqueue function
add_action('wp_enqueue_scripts', 'compado_enqueue_scripts');

// Shortcode to display products
function compado_display_products() {
    $options = get_option('compado_settings');
    $api_url = esc_url_raw($options['compado_text_field_api_url']);

    $compado_api = new Compado_API($api_url);

    $products = $compado_api->get_products();

    ob_start();
    if (!empty($products)) {
        echo '<div class="compado-products-wrapper">';
        foreach ($products as $product) {
            echo '<div class="compado-product">';
            echo '<div class="default-flag">';
            echo '<p class="flag-text">' .esc_html($product['flag']) . '</p>';
            echo '</div>';
            echo '<div class="content-wrapper">';
            echo '<div class="compado-product-content">';

            // Use the desired image URL format
            $image_url = str_replace('http://media/', 'https://media.api-domain-compado.com/media/', esc_url($product['logo_image'])) . '?d=200x120&q=100';

            echo '<img width="170" height="120" src="' . $image_url . '" alt="' . esc_attr($product['partner_name']) . '">';
            echo '<div>';
            echo '<h2 class="compado-product-header">' . esc_html($product['partner_name']) . '</h2>';
            echo '<div class="compado-marketing-properties">';
            echo "<div>";
            foreach ($product['marketing_properties'] as $key => $value) {
                if ($key === 'discount_button') {
                    // Display the discount button
                    echo "<span class='discount-button'>" . htmlspecialchars($value) . "</span>";
                }
            }
            echo "</div>";
            echo '</div>';
            echo '</div>';
            echo '<div>';
            echo '<p>' . esc_html($product['score']) . '</p>';
            // Display rating stars
            if (isset($product['rating']) && $product['rating'] > 0) {
                $rating = intval($product['rating']); // Assuming rating is an integer value
                echo '<div class="compado-rating">';
                for ($i = 0; $i < 5; $i++) {
                    if ($i < $rating) {
                        echo '<img data-v-3c5eba54="" src="https://media.api-domain-compado.com/img/icons/rating-icons/star.svg?d=18x18&amp;color=F7CB59FF" width="18" height="18" alt="rating icon">';
                    } else {
                        echo '<img data-v-3c5eba54="" src="https://media.api-domain-compado.com/img/icons/rating-icons/star.svg?d=18x18&amp;color=FFEBB8FF" width="18" height="18" alt="rating icon" class="inactive-half-icon">';
                    }
                }
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '<div class="compado-bottom-row">';
            echo '<div class="compado-icons-row">';
            echo '<div class="icon">';
            echo '<img data-v-7498d182="" width="32px" height="32px" alt="mealkits" style="width: 32px; height: 32px;" data-src="https://media.api-domain-compado.com/img/icons/partner-icons/mealkits.svg?q=100&amp;d=32x32&amp;color=686769" src="https://media.api-domain-compado.com/img/icons/partner-icons/mealkits.svg?q=100&amp;d=32x32&amp;color=686769" lazy="loaded">';
            echo '<span class="compado-bottom-row-icon-text">Meal Kits</span>';
            echo '</div>';
            echo '<div class="icon">';
            echo '<img data-v-7498d182="" width="32px" height="32px" alt="vegetarian" style="width: 32px; height: 32px;" data-src="https://media.api-domain-compado.com/img/icons/partner-icons/vegetarian.svg?q=100&amp;d=32x32&amp;color=686769" src="https://media.api-domain-compado.com/img/icons/partner-icons/vegetarian.svg?q=100&amp;d=32x32&amp;color=686769" lazy="loaded">';
            echo '<span class="compado-bottom-row-icon-text">Vegeterian</span>';
            echo '</div>';
            echo '<div class="icon">';
            echo '<img data-v-7498d182="" width="32px" height="32px" alt="vegan" style="width: 32px; height: 32px;" data-src="https://media.api-domain-compado.com/img/icons/partner-icons/vegan.svg?q=100&amp;d=32x32&amp;color=686769" src="https://media.api-domain-compado.com/img/icons/partner-icons/vegan.svg?q=100&amp;d=32x32&amp;color=686769" lazy="loaded">';
            echo '<span class="compado-bottom-row-icon-text">Vegan</span>';
            echo '</div>';
            echo '<div class="icon">';
            echo '<img data-v-7498d182="" width="32px" height="32px" alt="mastercard" style="width: 32px; height: 32px;" data-src="https://media.api-domain-compado.com/img/icons/partner-icons/mastercard.svg?q=100&amp;d=32x32&amp;color=686769" src="https://media.api-domain-compado.com/img/icons/partner-icons/mastercard.svg?q=100&amp;d=32x32&amp;color=686769" lazy="loaded">';
            echo '<span class="compado-bottom-row-icon-text">Mastercard</span>';
            echo '</div>';
            echo '<div class="icon">';
            echo '<img data-v-7498d182="" width="32px" height="32px" alt="paypal" style="width: 32px; height: 32px;" data-src="https://media.api-domain-compado.com/img/icons/partner-icons/paypal.svg?q=100&amp;d=32x32&amp;color=686769" src="https://media.api-domain-compado.com/img/icons/partner-icons/paypal.svg?q=100&amp;d=32x32&amp;color=686769" lazy="loaded">';
            echo '<span class="compado-bottom-row-icon-text">Paypal</span>';
            echo '</div>';

            echo '</div>';
            echo '<a href="' . esc_url($product['api_clickout']) . '">Visit Site</a>';
            echo '</div>';
            echo '</div>';
            if (isset($product['introduction'])) {
                echo '<div class="compado-read-more">';
                echo '<button class="compado-read-more-btn">Read More</button>';
                echo '<div class="compado-introduction">' . wp_kses_post($product['introduction']) . '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>' . __('No products found.', 'compado-product-display') . '</p>';
    }
    return ob_get_clean();
}

// AJAX handler for loading products
function compado_load_products_ajax() {
    check_ajax_referer('compado-ajax-nonce', 'nonce');

    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'default';
    echo compado_display_products();

    wp_die(); // Always use wp_die() at the end of AJAX handlers
}

add_action('wp_ajax_load_compado_products', 'compado_load_products_ajax');
add_action('wp_ajax_nopriv_load_compado_products', 'compado_load_products_ajax');

add_shortcode('compado_products', 'compado_display_products');
