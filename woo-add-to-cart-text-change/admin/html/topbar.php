<?php
$min_max_img = $this->base_url . 'assets/images/logo.png';

/**
 * This following part actually
 * for our both version
 * 
 */

$topbar_sub_title = __( 'Manage and Settings', 'wc-quantity-plus-minus-button' );
if( isset( $this->topbar_sub_title ) && ! empty( $this->topbar_sub_title ) ){
    $topbar_sub_title = $this->topbar_sub_title;
}
?>
<div class="wqpmb-header wqpmb-clearfix">
    <div class="container-flued">
        <div class="col-lg-7">
            <div class="wqpmb-logo-wrapper-area">
                <div class="wqpmb-logo-area">
                    <img src="<?php echo esc_url( $min_max_img ); ?>" class="wqpmb-brand-logo">
                </div>
                <div class="wqpmb-main-title">
                    <h2 class="wqpmb-ntitle"><?php _e("Add to cart Text", 'wc-quantity-plus-minus-button');?></h2>
                </div>
                
                <div class="wqpmb-main-title wqpmb-main-title-secondary">
                    <h2 class="wqpmb-ntitle"><?php echo esc_html( $topbar_sub_title );?></h2>
                </div>

            </div>
        </div>
        <div class="col-lg-5">
            <div class="header-button-wrapper">
                
                
                <a class="wqpmb-button reset" 
                    href="https://demo.wooproducttable.com/product/couple-jewelry/" 
                    target="_blank">
                    <i class="wqpmb_icon-note"></i>Demo
                </a>
            </div>
        </div>
    </div>
</div>