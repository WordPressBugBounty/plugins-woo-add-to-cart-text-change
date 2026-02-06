<?php
class Wactc_Placeholder_premium
{
    public $is_premium;

    public function __construct()
    {
        $this->is_premium = watctc_fs()->is_premium();
    }

    public function run()
    {
        //Actually if premium enabled, then it will not called/Execute
        if( $this->is_premium ) return;
        add_action('wactc_after_form_render', [$this, 'preimum_form_placeholder']);
    }

    public function preimum_form_placeholder()
    {
        ?>
            <div class="wqpmb-section-panel premium-settings premium-placeholder" id="wqpmb-premium-settings">

                <table class="wqpmb-table universal-setting">
                    <thead>
                        <tr>
                            <th class="wqpmb-inside">
                                <div class="wqpmb-table-header-inside">
                                    <h3 style="color: #e02b06ff;"><?php echo esc_html__( '🔒 Premium Features - Unlock Now!', 'wactc' ); ?></h3>
                                </div>
                                
                            </th>
                            
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td colspan="2" style="padding: 20px;">
                                <div style="opacity: 0.86; pointer-events: none;">
                                    <h4 style="margin-top: 0;"><?php echo esc_html__( '✨ Advanced Button Text Customization', 'wactc' ); ?></h4>
                                    <ul style="list-style: disc; padding-left: 25px; line-height: 1.8;">
                                        <li><strong><?php echo esc_html__( 'Per-Product Custom Text', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Set unique button text for each product individually', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Category-Based Text', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Different button text for different product categories', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Out of Stock Button Text', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Custom text like "Notify Me" for unavailable products', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'On Sale Button Text', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Special text like "Grab the Deal!" for sale items', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Backorder & External Product Text', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Customize text for all product types', 'wactc' ); ?></li>
                                    </ul>

                                    <h4><?php echo esc_html__( '🎨 Professional Button Styling', 'wactc' ); ?></h4>
                                    <ul style="list-style: disc; padding-left: 25px; line-height: 1.8;">
                                        <li><strong><?php echo esc_html__( 'Custom Colors', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Set background, text, and hover colors', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Border Radius Control', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Make buttons rounded or square', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Custom CSS Editor', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Add your own CSS for advanced styling', 'wactc' ); ?></li>
                                    </ul>

                                    <h4><?php echo esc_html__( '⚡ Advanced Features', 'wactc' ); ?></h4>
                                    <ul style="list-style: disc; padding-left: 25px; line-height: 1.8;">
                                        <li><strong><?php echo esc_html__( 'AJAX Add to Cart', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Add products to cart without page reload', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Priority Support', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Get help directly from the developer', 'wactc' ); ?></li>
                                        <li><strong><?php echo esc_html__( 'Regular Updates', 'wactc' ); ?></strong> - <?php echo esc_html__( 'Always stay compatible with latest WooCommerce', 'wactc' ); ?></li>
                                    </ul>
                                </div>

                                <div style="margin-top: 43px;text-align: center;padding: 20px;background: linear-gradient(45deg, #f3d287, #91c3ee);border-radius: 16px;border: 0 none;">
                                    <h3 style="color: #e02b06ff; margin-top: 0;"><?php echo esc_html__( '🚀 Upgrade to Premium Today!', 'wactc' ); ?></h3>
                                    <p style="font-size: 16px; margin: 15px 0;"><?php echo esc_html__( 'Unlock all these powerful features and take your WooCommerce store to the next level!', 'wactc' ); ?></p>
                                    <a href="<?php echo esc_url( watctc_fs()->get_upgrade_url() ); ?>" class="button button-primary button-hero" style="background: #d63638;border-color: #933f05; box-shadow: 0 2px 5px rgba(0,0,0,0.2); font-size: 24px; padding: 10px 30px;">
                                        <span class="dashicons dashicons-star-filled" style="vertical-align: middle; margin-right: 5px;"></span>
                                        <?php echo esc_html__( 'Upgrade to Premium Now', 'wactc' ); ?>
                                    </a>
                                    <p style="margin-top: 15px; color: #666;">
                                        <small><?php echo esc_html__( '30-day money-back guarantee • Lifetime updates • Priority support', 'wactc' ); ?></small>
                                    </p>
                                </div>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div><!-- /#wqpmb-premium-settings -->
        <?php 
    }
}