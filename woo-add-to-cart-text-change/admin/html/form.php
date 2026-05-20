<?php
global $wactc_default_args;
$message = '';





$saved_data = get_option('wactc_default_add_to_cart_text');

$saved_data = wp_parse_args( $saved_data, $wactc_default_args );
?>

<div class="wrap wqpmb_wrap wqpmb-content">
    <h1 class="wp-heading "></h1>
    <div class="fieldwrap">


        <form action="" method="POST">
            <input type="hidden" name="wactc_nonce" value="<?php echo wp_create_nonce( plugin_basename( 'add-to-cart-nonce' ) ); ?>">
            <div class="wqpmb-section-panel no-background wqpmb-full-form-submit-wrapper">
                
                <button name="submit" type="submit"
                    class="wqpmb-btn wqpmb-has-icon configure_submit">
                    <span><i class="wqpmb_icon-floppy"></i></span>
                    <strong class="form-submit-text">
                    <?php echo esc_html__('Save Change','wc-quantity-plus-minus-button');?>
                    </strong>
                </button>
            </div>
            <div class="wqpmb-section-panel">
                <?php echo wp_kses_post( $message ); ?>
            </div>
            <div class="wqpmb-section-panel button-settings" id="wqpmb-button-settings">

                <table class="wqpmb-table universal-setting">
                    <thead>
                        <tr>
                            <th class="wqpmb-inside">
                                <div class="wqpmb-table-header-inside">
                                    <h3><?php echo esc_html__( 'Button Settings', 'wc-quantity-plus-minus-button' ); ?></h3>
                                </div>
                                
                            </th>
                            <th>
                            <div class="wqpmb-table-header-right-side"></div>
                            </th>
                        </tr>
                    </thead>

                    <tbody>


                        
                        <!-- Input box width. Added at version 1.1.9 -->
                        <tr>
                            <td>
                                <div class="wqpmb-form-control">
                                    <div class="form-label col-lg-6">
                                        <label for="wqpmn-inputbox-width"><?php echo esc_html__( 'For Single Product Page', 'wactc' ); ?></label>
                                    </div>
                                    <div class="form-field col-lg-6">
                                        <input name="data[simple]" value="<?php echo esc_attr( sanitize_text_field( $saved_data['simple'] ?? '' ) ); ?>"  type="text">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wqpmb-form-info">
                                    <p>Text for Add to button text for Single product.</p>
                                </div> 
                            </td>
                        </tr>
                        <!-- Input box height. Added at version 1.1.9 -->
                        <tr>
                            <td>
                                <div class="wqpmb-form-control">
                                    <div class="form-label col-lg-6">
                                        <label for="wqpmn-inputbox-height"><?php echo esc_html__( 'Icon Setting', 'wactc' ); ?></label>
                                    </div>
                                    <div class="form-field col-lg-6">
                                        <select  name="data[icon]">
                                            <option value="no_icon" <?php echo $saved_data['icon'] == 'no_icon' ? esc_attr( 'selected' ) : ''; ?>><?php echo esc_html__( 'No Icon', 'wactc' ); ?></option>
                                            <option value="only_icon" <?php echo $saved_data['icon'] == 'only_icon' ? esc_attr( 'selected' ) : ''; ?>><?php echo esc_html__( 'Only Icon', 'wactc' ); ?></option>
                                            <option value="icon_left" <?php echo $saved_data['icon'] == 'icon_left' ? esc_attr( 'selected' ) : ''; ?>><?php echo esc_html__( 'Icon at Left', 'wactc' ); ?></option>
                                            <option value="icon_right" <?php echo $saved_data['icon'] == 'icon_right' ? esc_attr( 'selected' ) : ''; ?>><?php echo esc_html__( 'Icon at Right', 'wactc' ); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wqpmb-form-info">
                                    <p>Set icon position for add to cart button.</p>
                                </div> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="wqpmb-form-control">
                                    <div class="form-label col-lg-6">
                                        <label for="wqpmb-input-bg-color-input"><?php echo esc_html__( 'Variable Product [In Loop/ShopPage]', 'wactc' ); ?></label>
                                    </div>
                                    <div class="form-field col-lg-6">
                                        <input name="data[variable]" value="<?php echo esc_attr( sanitize_text_field( $saved_data['variable'] ?? '' ) ); ?>"  type="text">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wqpmb-form-info">
                                    <p>Button text for variable product</p>
                                </div> 
                            </td>
                        </tr>
                            
                        <tr>
                            <td>
                                <div class="wqpmb-form-control">
                                    <div class="form-label col-lg-6">
                                    <label for="wqpmb-input-border-color-input"><?php echo esc_html__( 'Grouped Product  [In Loop/ShopPage]', 'wactc' ); ?></label>
                                    </div>
                                    <div class="form-field col-lg-6">
                                        <input name="data[grouped]" value="<?php echo esc_attr( sanitize_text_field( $saved_data['grouped'] ?? '' ) ); ?>"  type="text">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="wqpmb-form-info">
                                    <p>For group productt.</p>
                                </div> 
                            </td>
                        </tr>
                        
                        
                    </tbody>
                </table>
            </div><!-- /#wqpmb-button-settings -->

            
            <?php do_action( 'wactc_after_form_render' ); ?>
            <div class="wqpmb-section-panel no-background wqpmb-full-form-submit-wrapper">
                
                <button name="submit" type="submit"
                    class="wqpmb-btn wqpmb-has-icon configure_submit">
                    <span><i class="wqpmb_icon-floppy"></i></span>
                    <strong class="form-submit-text">
                    <?php echo esc_html__('Save Change','wc-quantity-plus-minus-button');?>
                    </strong>
                </button>
                <button name="reset" 
                    class="wqpmb-btn reset wqpmb-has-icon reset_button"
                    onclick="return confirm('If you continue with this action, you will reset all options in this page.\nAre you sure?');">
                    <span><i class="wqpmb_icon-arrows-cw "></i></span>
                    <?php echo esc_html__( 'Reset Settings', 'wc-quantity-plus-minus-button' ); ?>
                </button>
                
            </div>

        </form>
        
    </div><!-- ./fieldwrap -->
</div> <!-- ./wrap wqpmb_wrap wqpmb-content -->

