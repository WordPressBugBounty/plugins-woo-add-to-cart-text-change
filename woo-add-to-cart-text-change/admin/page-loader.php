<?php 
include 'placeholder-premium.php';
class Wactc_Page_Loader{

    protected $plugin_prefix = 'wactc';
    protected $dev_version = WACTC_VERSION;

    public $base_url = WACTC_BASE_URL;
    public $is_pro = false;
    public $is_premium;

    public $admin_dir;
    public $html_dir;



    public function __construct()
    {
        $this->admin_dir = WACTC_BASE_DIR . 'admin/';
        $this->html_dir = $this->admin_dir . 'html/';

        $this->is_premium = $this->is_pro = watctc_fs()->is_premium();

        add_action( 'admin_menu', [$this, 'admin_menu'] );
        
        //admin eneque here
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts'] );

        add_filter( 'plugin_action_links_' . WACTC_PLUGIN_BASE_FILE, [$this, 'plugin_page_action_links'] );

        $placeholder = new Wactc_Placeholder_premium();
        $placeholder->run();
    }

    //write fun for admin_enqueue_scripts
    public function admin_enqueue_scripts() {

        global $current_screen;

        $s_id = isset( $current_screen->id ) ? $current_screen->id : '';

        if( strpos( $s_id, $this->plugin_prefix ) === false ) return;

        wp_enqueue_style('wactc-admin-style-c', WACTC_BASE_URL . 'assets/css/admin-common.css', array(), WACTC_VERSION);
        wp_enqueue_style('wactc-admin-style-s', WACTC_BASE_URL . 'assets/css/admin-style.css', array(), WACTC_VERSION);
        wp_enqueue_style('wactc-admin-style-n', WACTC_BASE_URL . 'assets/css/new-admin.css', array(), WACTC_VERSION);
        // wp_enqueue_script('wactc-admin-script', WACTC_BASE_URL . 'assets/js/script.js', array('jquery'), WACTC_VERSION, true);

        wp_register_style( $this->plugin_prefix . '-icon-font', $this->base_url . 'assets/fontello/css/wqpmb-icon.css', false, $this->dev_version );
        wp_enqueue_style( $this->plugin_prefix . '-icon-font' );

        
        wp_register_style( $this->plugin_prefix . '-icon-animation', $this->base_url . 'assets/fontello/css/animation.css', false, $this->dev_version );
        wp_enqueue_style( $this->plugin_prefix . '-icon-animation' );
    }

    /**
     * Menu under WooCommerce
     * 
     */
    public function admin_menu() {
        add_submenu_page( 'woocommerce', esc_html__( 'ADD TO CART', 'woo-add-to-cart-text-change' ), esc_html__( 'ADD TO CART', 'woo-add-to-cart-text-change' ), 'manage_options', 'wactc-add-to-cart-button', [$this, 'settings'] );
    }


    public function settings() { 

        $this->submit();
        // var_dump($this->html_dir . 'form.php'); 
        // var_dump(is_file($this->html_dir . 'form.php'));
        include $this->html_dir . 'topbar.php';
        include $this->html_dir . 'form.php';
        
    }

    /**
     * Submit form data and Check by Nonce Actually
     *
     * @return void
     */
    public function submit(){
        global $wactc_default_args;
        
        $nonce = sanitize_text_field( wp_unslash( $_POST['wactc_nonce'] ?? '' ) );

        if( empty( $nonce ) || ! wp_verify_nonce( $nonce, 'add-to-cart-nonce' ) ) {
            return;
        }

        // Hook for premium settings save
        do_action( 'wactc_before_save_settings' );

        if( isset($_POST['reset']) ){
            $message = "<h2 class='message_reset'>" . esc_html__( 'Reset Successfully', 'wactc' ) . "</h2>";

            $sanitized_default_args = [];
            //Sanitized $wactc_default_args
            if( is_array( $wactc_default_args ) ){
                foreach( $wactc_default_args as $key => $value ){

                    $sanitized_default_args[$key] = sanitize_text_field( $value );
                }
            }

            //Sanitized whole array using sanitized_text_field()
            update_option( 'wactc_default_add_to_cart_text', $sanitized_default_args );
        }elseif( isset($_POST['submit']) && isset($_POST['data']) && is_array( $_POST['data'] )){ 
            $message = "<h2 class='message_successs'>" . esc_html__( 'Data Updated Successfully', 'wactc' ) . "</h2>";
            $data = isset( $_POST['data'] ) ? $_POST['data'] : $wactc_default_args;
            
            $final_data = array();
            $final_data['simple'] = sanitize_text_field( $data['simple'] ?? '' );
            $final_data['icon'] = sanitize_text_field( $data['icon']  ?? '' );
            $final_data['variable'] = sanitize_text_field( $data['variable']  ?? '' );
            $final_data['grouped'] = sanitize_text_field( $data['grouped']  ?? '' );

            $sanitized_final_data = [];
            //Sanitized $final_data
            if( is_array( $final_data ) ){
                foreach( $final_data as $key => $value ){

                    $sanitized_final_data[$key] = sanitize_text_field( $value );
                }
            }
            update_option( 'wactc_default_add_to_cart_text', $sanitized_final_data );
        }
    }    

    public function plugin_page_action_links( $links )
    {
        $wactc_links[] = '<a href="' . esc_url( admin_url('admin.php?page=wactc-add-to-cart-button') ) . '" title="' . esc_attr( __( 'Add to Cart Setting Page', 'wactc' ) ) . '">' . esc_html( __( 'Setting Page', 'wactc' ) ) . '</a>';
    
        return array_merge( $wactc_links, $links );
    }

}