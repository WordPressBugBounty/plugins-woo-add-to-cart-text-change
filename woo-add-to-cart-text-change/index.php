<?php

/**
 * Plugin Name: Add to Cart Text Change for WooCommerce
 * Requires Plugins: woocommerce
 * Description: WooCommerce Product's [ Add to cart ] Button text change and easily set custom text by your own language. WooCommerce is one of the best Ecommerce plugin. Sometime can be need to change Add_to_cart Button text changing.
 * Plugin URI: https://wordpress.org/plugins/woo-add-to-cart-text-change/
 * Author: Saiful Islam
 * Version: 2.3.0
 * Author URI: https://profiles.wordpress.org/codersaiful
 * 
 * Requires at least:    4.0.0
 * Tested up to:         6.9
 * WC requires at least: 3.0.0
 * WC tested up to: 	 10.2.2
 * 
 * Text Domain: woo-add-to-cart-text-change
 * Domain Path: /languages/
 *
 *
 * @package WACTC
 * @category Core
 *
 */
// don't load directly
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
// return;
//End Activation
$wactc_default_args = array(
    'icon'     => 'no_icon',
    'simple'   => __( 'Add to cart', 'wactc' ),
    'variable' => __( 'Select options', 'wactc' ),
    'grouped'  => __( 'View products', 'wactc' ),
    'external' => '',
);
include_once ABSPATH . 'wp-admin/includes/plugin.php';
define( 'WACTC_VERSION', '2.3.0.0' );
define( 'WACTC_NAME', __( 'Add to Cart Text Changer', 'wactc' ) );
define( 'WACTC_PLUGIN_BASE_FOLDER', plugin_basename( dirname( __FILE__ ) ) );
define( 'WACTC_PLUGIN_BASE_FILE', plugin_basename( __FILE__ ) );
define( "WACTC_BASE_URL", plugins_url() . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( "wactc_dir_base", dirname( __FILE__ ) . '/' );
define( "WACTC_BASE_DIR", str_replace( '\\', '/', wactc_dir_base ) );
//Define Options Path
define( 'WACTC_TABLE_OPTIONS_PATH', WACTC_BASE_DIR . 'modules/options' . DIRECTORY_SEPARATOR );
define( 'WACTC_TABLE_OPTIONS_URL', WACTC_BASE_URL . 'modules/options' );
/**
 * Freemius integration
 * 
 */
if ( function_exists( 'watctc_fs' ) ) {
    watctc_fs()->set_basename( false, __FILE__ );
} else {
    /**
     * DO NOT REMOVE THIS IF, IT IS ESSENTIAL FOR THE
     * `function_exists` CALL ABOVE TO PROPERLY WORK.
     */
    if ( !function_exists( 'watctc_fs' ) ) {
        // Create a helper function for easy SDK access.
        function watctc_fs() {
            global $watctc_fs;
            if ( !isset( $watctc_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/vendor/freemius/start.php';
                $watctc_fs = fs_dynamic_init( array(
                    'id'             => '21361',
                    'slug'           => 'woo-add-to-cart-text-change',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_cc8ed1cdf6500527d7f1078879f6d',
                    'is_premium'     => false,
                    'premium_suffix' => 'Premium',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                        'slug'        => 'wactc-add-to-cart-button',
                        'first-path'  => 'admin.php?page=wactc-add-to-cart-button',
                        'support'     => false,
                        'affiliation' => false,
                        'parent'      => array(
                            'slug' => 'woocommerce',
                        ),
                    ),
                    'is_live'        => true,
                ) );
            }
            return $watctc_fs;
        }

        // Init Freemius.
        watctc_fs();
        // Signal that SDK was initiated.
        do_action( 'watctc_fs_loaded' );
    }
    // ... Your plugin's main file logic ...
}
include WACTC_BASE_DIR . 'includes/functions.php';
add_action( 'plugins_loaded', 'wactc_free_plugin_loaded' );
function wactc_free_plugin_loaded() {
    // Check if WooCommerce Activated
    if ( !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
        add_action( 'admin_notices', 'wactc_free_admin_notice_missing_wc' );
        return;
    }
    // Declare compatibility with custom order tables for WooCommerce.
    add_action( 'before_woocommerce_init', function () {
        if ( class_exists( '\\Automattic\\WooCommerce\\Utilities\\FeaturesUtil' ) ) {
            \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'custom_order_tables', __FILE__, true );
        }
    } );
    if ( is_admin() ) {
        // include( WACTC_BASE_DIR . 'admin/plugin_setting_link.php' ); //To show Setting link at plugin page
        // include( WACTC_BASE_DIR . 'admin/menu.php' ); //Adding menu to Dashboard.
        // include( WACTC_BASE_DIR . 'admin/button_text_form.php' ); //Add to Cart Button text Customizing form.
        //New updated and added
        include WACTC_BASE_DIR . 'admin/page-loader.php';
        //Add to Cart Button text Customizing form.
        new Wactc_Page_Loader();
    }
    $wactc_values = get_option( 'wactc_default_add_to_cart_text' );
    if ( !empty( $wactc_values ) && is_array( $wactc_values ) ) {
        include_once WACTC_BASE_DIR . 'includes/add_to_cart_front.php';
        //Add Filter for add to cart button
    }
    $pro_file = dirname( __FILE__ ) . '/premium/premium-loader.php';
    if ( watctc_fs()->can_use_premium_code__premium_only() && file_exists( $pro_file ) ) {
        require_once $pro_file;
    }
}

/**
 * Admin notice
 *
 * Warning when the site doesn't have Elementor installed or activated.
 *
 * @since 1.0.0
 *
 * @access public
 */
function wactc_free_admin_notice_missing_wc() {
    $message = sprintf( esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wactc' ), '<strong>' . WACTC_NAME . '</strong>', '<strong><a href="' . esc_url( 'https://wordpress.org/plugins/woocommerce/' ) . '" target="_blank">' . esc_html__( 'WooCommerce', 'wactc' ) . '</a></strong>' );
    printf( '<div class="notice notice-error is-dismissible"><p>%1$s</p></div>', $message );
}

/**
 * Plugin Install function
 * 
 * @package WooCommerce add to cart Text change
 * @since v1.0
 */
function wactc_free_install() {
    global $wactc_default_args;
    $current = get_option( 'wactc_default_add_to_cart_text' );
    if ( $current && !is_array( $current ) && is_string( $current ) ) {
        $wactc_default_args['simple'] = $current;
    } else {
        $wactc_default_args = $current;
    }
    $sanitized_default_args = [];
    //Sanitized $wactc_default_args
    if ( is_array( $wactc_default_args ) ) {
        foreach ( $wactc_default_args as $key => $value ) {
            $sanitized_default_args[$key] = sanitize_text_field( $value );
        }
    }
    update_option( 'wactc_default_add_to_cart_text', $sanitized_default_args );
}

add_action( 'init', 'wactc_i18n' );
function wactc_i18n() {
    load_plugin_textdomain( 'woo-add-to-cart-text-change', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Plugin Uninstallation
 * Currently nothing to do.
 * 
 * @package WooCommerce add to cart Text change
 * @since v1.0
 */
function wactc_free_uninstall() {
    //Nothing to do.
}

register_activation_hook( __FILE__, 'wactc_free_install' );
register_deactivation_hook( __FILE__, 'wactc_free_uninstall' );